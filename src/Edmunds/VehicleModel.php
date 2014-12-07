<?php
namespace CarRived\Edmunds;

/**
 * A vehicle model is specific vehicle brand identified by a name or number
 * (and which is usually further classified by trim or style level).
 */
class VehicleModel extends RemoteObject
{
    /**
     * Gets the make of the model.
     *
     * @return [type] [description]
     */
    public function getMake()
    {
        return new VehicleMake($this->client, $this->make);
    }

    public function getYear($year)
    {
        // check if years have been cached
        if (isset($this->years)) {
            $object = $this->findObjectBy($this->years, 'year', (int)$year);

            if ($object === null) {
                throw new ApiException("The model year does not exist.", 404);
            }

            // pass in a reference to this make and model
            $object->make = $this->make;
            $object->model = new \stdClass();
            $object->model->id = $this->id;
            $object->model->name = $this->name;
            $object->model->niceName = $this->niceName;

            return new VehicleModelYear($this->client, $object);
        } else {
            $url = sprintf('/api/vehicle/v2/%s/%s/%d', $this->make->niceName, $this->niceName, $year);

            $response = $this->client->makeCall($url, ['view' => 'full']);
            return new VehicleModelYear($this->client, $response);
        }
    }

    public function getYears($state = null, $submodel = null, $category = null)
    {
        // check if years have been cached
        if (!isset($this->years)) {
            $url = sprintf('/api/vehicle/v2/%s/%s/years', $this->make->niceName, $this->niceName);
            $params = compact('state', 'submodel', 'category') + [
                'view' => 'full'
            ];

            $response = $this->client->makeCall($url, $params);
            $this->years = $response->years;
        }

        return array_map(function ($object) {
            return new VehicleModelYear($this->client, $object);
        }, $this->years);
    }
}
