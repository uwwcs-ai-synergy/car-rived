<?php
namespace CarRived\Edmunds;

/**
 * Represents a particular style of a specific make/model/year vehicle and
 * includes the engine, transmission, colors, options, trim and squishVin
 * details for that style.
 */
class VehicleStyle extends RemoteObject
{
    /**
     * Gets the make of the vehicle style.
     *
     * @return [type] [description]
     */
    public function getMake()
    {
        return new VehicleMake($this->client, $this->make);
    }

    /**
     * Gets the model of the vehicle style.
     *
     * @return [type] [description]
     */
    public function getModel()
    {
        return new VehicleModel($this->client, $this->model);
    }

    /**
     * Gets the model year of the vehicle style.
     *
     * @return [type] [description]
     */
    public function getModelYear()
    {
        return new VehicleModelYear($this->client, $this->year);
    }

    public function getPhotos()
    {
        return $this->client->getStylePhotos($this->id);
    }
}
