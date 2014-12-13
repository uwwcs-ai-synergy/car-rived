<?php
namespace CarRived;

/**
 * Searches vehicles based on a flexible set of rules.
 */
class VehicleSearcher
{
    protected $client;
    protected $ruleSet;
    protected $trainingSet;
    protected $foundNodes;
    protected $finalLeaf = 3;

    /**
     * Creates a new searcher.
     *
     * @param Edmunds\VehicleApiClient $client The API client to use.
     * @param RuleSet                  $rules  A rule set to search by.
     */
    public function __construct(Edmunds\VehicleApiClient $client, RuleSet $rules)
    {
        $this->client = $client;
        $this->ruleSet = $rules;
    }

    /**
     * Gets the rule set being used.
     *
     * @return RuleSet
     */
    public function getRuleSet()
    {
        return $this->ruleSet;
    }

    /**
     * Gets the training set used for machine learning.
     *
     * @return VehicleStyle[]
     */
    public function getTrainingSet()
    {
        return $this->trainingSet;
    }

    /**
     * Sets the training set to use for machine learning.
     *
     * @param VehicleStyle[] $trainingSet
     */
    public function setTrainingSet(array $trainingSet)
    {
        $this->trainingSet = $trainingSet;
    }

    /**
     * Searches for relevant vehicles - within a given make.
     *
     * @param  string $make      The make to restrict search by.
     * @param  int    $nodeCount The number of vehicles to return.
     * @return VehicleStyle[]
     */
    public function search($make, $nodeCount = 9)
    {
        //if choosing any make, finalLeaf should be 4
        //$this->finalLeaf = 4;
        //$rootNode = SearchNode::fromClient($this->client);

        // restrict search by new and make or search becomes very slow
        $rootNode = SearchNode::fromRemoteObject($this->client->getMake($make, Edmunds\VehicleApiClient::STATE_NEW));
        // found nodes are returned into this property
        $this->foundNodes = new \SplDoublyLinkedList();

        $this->searchNode($rootNode, $nodeCount);

        // array of vehicles to return
        $vehicles = [];
        foreach ($this->foundNodes as $node) {
            // get the actual vehicle for each found node to return
            $vehicles[] = $node->getObject();
        }
        return $vehicles;
    }

    /**
     * Gets the heuristic value of a node.
     *
     * @param  SearchNode $node  The node to evaluate.
     * @param  int        $depth The node depth in the tree.
     * @return int               The heuristic value of the node.
     */
    protected function nodeValue(SearchNode $node, $depth)
    {
        // generalize node
        $generalNode = $this->generalizeNode($node, $this->finalLeaf - $depth);

        if ($generalNode !== null) {
            return $this->ruleSet->heuristic($generalNode->getObject());
        }
        return 100000;
    }

    /**
     * Generalizes a node if it is not a specific vehicle make / style.
     *
     * @param  SearchNode $node        The node to generalize.
     * @param  [type]     $targetDepth The number of levels to generalize by.
     * @return SearchNode              The generalied node.
     */
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
        /*$children = $node->getChildren();

        if (count($children) > 0) {
            return $this->generalizeNode($children[0], $targetDepth + 1);
        }

        if ($targetDepth === $this->finalLeaf)
            return $node;
        return null;*/
    }

    /**
     * Modified depth-first search algorithm.
     *
     * This adaptation of DFS has no target to find. Instead it fills a list of
     * nodes that have high heuristic values.
     *
     * @param  SearchNode $parent The
     * @param  integer    $depth  [description]
     */
    protected function searchNode(SearchNode $parent, $nodeCount, $depth = 0)
    {
        $parentValue = $this->nodeValue($parent, $depth);
        //printf("Examining object at depth %d of value %d\r\n", $depth, $parentValue);

        // if this is a leaf, see if we can add it to our list
        if ($depth === $this->finalLeaf) {
            // obviously if we have nothing yet we can add it
            if ($this->foundNodes->isEmpty()) {
                $this->foundNodes->push($parent);
            }

            // keep it sorted by inserting it sorted by value
            for ($i = 0; $i < count($this->foundNodes); $i++) {
                if ($parentValue > $this->nodeValue($this->foundNodes[$i], $this->finalLeaf)) {
                    $this->foundNodes->add($i, $parent);
                    break;
                }
            }

            // keep list trimmed to max length
            if (count($this->foundNodes) > $nodeCount) {
                $this->foundNodes->pop();
            }
        }

        // search child nodes as well
        foreach ($parent->getChildren() as $child) {
            $this->searchNode($child, $nodeCount, $depth + 1);
        }
    }
}
