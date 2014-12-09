<?php
namespace CarRived;

class VehicleSearcher
{
    protected $client;
    protected $ruleSet;
    protected $foundNodes;
    protected $finalLeaf = 3;

    public function __construct(Edmunds\VehicleApiClient $client, RuleSet $rules)
    {
        $this->client = $client;
        $this->ruleSet = $rules;
    }

    public function getRuleSet()
    {
        return $this->ruleSet;
    }

    public function search($make, $nodeCount)
    {
        //if choosing any make, finalLeaf should be 4
        //$rootNode = SearchNode::fromClient($this->client);
        $rootNode = SearchNode::fromRemoteObject($this->client->getMake($make, Edmunds\VehicleApiClient::STATE_NEW));
        $this->foundNodes = new \SplDoublyLinkedList();

        //var_dump($rootNode);
        //var_dump($rootNode->getChildren()[0]->getChildren()[0]->getChildren()[0]->getObject()->price);
        $this->searchNode($rootNode, $nodeCount);

        $vehicles = [];
        foreach ($this->foundNodes as $node) {
            $vehicles[] = $node->getObject();
        }
        return $vehicles;
    }

    protected function nodeValue(SearchNode $node, $depth)
    {
        $generalNode = $this->generalizeNode($node, $this->finalLeaf - $depth);

        if ($generalNode)
            return $this->ruleSet->heuristic($generalNode->getObject());
        return 100000;
    }

    protected function generalizeNode(SearchNode $node, $targetDepth)
    {
        if ($targetDepth === 0) {
            return $node;
        } else {
            $children = $node->getChildren();

            if (count($children) > 0) {
                return $this->generalizeNode($children[0], $targetDepth - 1);
            }

            return null;
        }

        // this stuff is old and probably not needed
        $children = $node->getChildren();

        if (count($children) > 0) {
            return $this->generalizeNode($children[0], $targetDepth + 1);
        }

        if ($targetDepth === $this->finalLeaf)
            return $node;
        return null;
    }

    /**
     * Modified depth-first search algorithm.
     *
     * This adaptation of DFS has no target to find. Instead
     *
     * @param  SearchNode $parent [description]
     * @param  integer    $depth  [description]
     * @return [type]             [description]
     */
    protected function searchNode(SearchNode $parent, $nodeCount, $depth = 0)
    {
        $parentValue = $this->nodeValue($parent, $depth);
        //printf("Examining object at depth %d of value %d\r\n", $depth, $parentValue);

        if ($depth === $this->finalLeaf) {
            if ($this->foundNodes->isEmpty()) {
                $this->foundNodes->push($parent);
            }

            for ($i = 0; $i < count($this->foundNodes); $i++) {
                if ($parentValue > $this->nodeValue($this->foundNodes[$i], $this->finalLeaf)) {
                    $this->foundNodes->add($i, $parent);
                    break;
                }
            }

            if (count($this->foundNodes) >= $nodeCount) {
                $this->foundNodes->pop();
            }
        }

        foreach ($parent->getChildren() as $child) {
            $this->searchNode($child, $nodeCount, $depth + 1);
        }
    }
}
