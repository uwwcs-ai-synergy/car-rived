<?php
namespace CarRived\Edmunds;

/**
 * A vehicle model year for a vehicle model is the calendar year designation
 * assigned by the manufacturer to the annual version of that model.
 */
class VehicleModelYear extends RemoteObject
{
    /**
     * Gets the make of the model year.
     *
     * @return [type] [description]
     */
    public function getMake()
    {
        return new VehicleMake($this->client, $this->make);
    }

    /**
     * Gets the model of the model year.
     *
     * @return [type] [description]
     */
    public function getModel()
    {
        return new VehicleModel($this->client, $this->model);
    }

    /**
     * Gets
     *
     * @param  [type] $state    [description]
     * @param  [type] $submodel [description]
     * @param  [type] $category [description]
     * @return [type]           [description]
     */
    public function getStyles($state = null, $submodel = null, $category = null)
    {
        // check if years have been cached
        if (isset($this->styles)) {
            return array_map(function ($object) {
                return new VehicleStyle($this->client, $object);
            }, $this->styles);
        }

        return $this->client->getModelStyles($this->make->niceName, $this->model->niceName, $this->year, $state, $submodel, $category);
    }
}
