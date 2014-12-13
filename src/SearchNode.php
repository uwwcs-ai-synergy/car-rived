<?php
namespace CarRived;

/**
 * Node in the search tree. Generically wraps different levels of vehicle nodes
 * in a type-safe way.
 */
class SearchNode
{
    protected $object;

    /**
     * Creates a node for an API client instance.
     *
     * @param  Edmunds\VehicleApiClient $client
     * @return SearchNode
     */
    public static function fromClient(Edmunds\VehicleApiClient $client)
    {
        return new self($client);
    }

    /**
     * Creates a node for a remote object.
     *
     * @param  Edmunds\RemoteObject $object
     * @return SearchNode
     */
    public static function fromRemoteObject(Edmunds\RemoteObject $object)
    {
        return new self($object);
    }

    /**
     * Gets the inner object.
     *
     * @return \stdClass
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Gets the children of the node.
     *
     * Uses the correct method for each inner node type. May make one or more
     * API requests.
     *
     * @return SearchNode[]
     */
    public function getChildren()
    {
        $items = [];

        if ($this->object instanceof Edmunds\VehicleApiClient) {
            $items = $this->object->getMakes(Edmunds\VehicleApiClient::STATE_NEW);
        } elseif ($this->object instanceof Edmunds\VehicleMake) {
            $items = $this->object->getModels(Edmunds\VehicleApiClient::STATE_NEW);
        } elseif ($this->object instanceof Edmunds\VehicleModel) {
            $items = $this->object->getYears(Edmunds\VehicleApiClient::STATE_NEW);
        } elseif ($this->object instanceof Edmunds\VehicleModelYear) {
            $items = $this->object->getStyles(Edmunds\VehicleApiClient::STATE_NEW);
        }

        return array_map(function ($object) {
            return self::fromRemoteObject($object);
        }, $items);
    }

    private function __construct($object)
    {
        $this->object = $object;
    }
}
