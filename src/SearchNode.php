<?php
namespace CarRived;

class SearchNode
{
    protected $object;

    public static function fromClient(Edmunds\VehicleApiClient $client)
    {
        return new self($client);
    }

    public static function fromRemoteObject(Edmunds\RemoteObject $object)
    {
        return new self($object);
    }

    public function getObject()
    {
        return $this->object;
    }

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
