<?php
namespace CarRived\Edmunds;

/**
 * A vehicle make is either the name of its manufacturer or, if the manufacturer
 * has more than one operating unit, the name of that unit.
 */
class VehicleMake extends RemoteObject
{
    public function getModel($model)
    {
        // check if models have been cached
        if (isset($this->models)) {
            $object = $this->findObjectBy($this->models, 'niceName', $model);

            if ($object === null) {
                throw new ApiException("The model does not exist.", 404);
            }

            // pass in a reference to this make
            $object->make = new \stdClass();
            $object->make->id = $this->id;
            $object->make->name = $this->name;
            $object->make->niceName = $this->niceName;

            return new VehicleModel($this->client, $object);
        } else {
            $url = sprintf('/api/vehicle/v2/%s/%s', $this->niceName, $model);

            $response = $this->client->makeCall($url, ['view' => 'full']);
            return new VehicleModel($this->client, $response);
        }
    }

    public function getModels($state = null, $year = null, $submodel = null, $category = null)
    {
        // check if models have been cached
        if (!isset($this->models)) {
            $url = sprintf('/api/vehicle/v2/%s/models', $this->niceName);

            $params = compact('state', 'year', 'submodel', 'category') + [
                'view' => 'full'
            ];

            $response = $this->client->makeCall($url, $params);
            $this->models = $response->models;
        }

        // return vehicle model objects for each model
        return array_map(function ($object) {
            return new VehicleModel($this->client, $object);
        }, $this->models);
    }
}
