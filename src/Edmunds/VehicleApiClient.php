<?php
namespace CarRived\Edmunds;

class VehicleApiClient extends ApiClient
{
    const STATE_NEW = 'new';
    const STATE_USED = 'used';
    const STATE_FUTURE = 'future';

    public function getMakes($state = null, $year = null)
    {
        $params = compact('state', 'year') + [
            'view' => 'full'
        ];

        $response = $this->makeCall('/api/vehicle/v2/makes', $params);

        // return vehicle make objects for each make found
        return array_map(function ($make) {
            return new VehicleMake($this, $make);
        }, $response->makes);
    }

    /**
     * Gets a make object by name.
     *
     * @param  [type] $name  [description]
     * @param  [type] $state [description]
     * @param  [type] $year  [description]
     * @return [type]        [description]
     */
    public function getMake($name)
    {
        $url = sprintf('/api/vehicle/v2/%s', $name);
        $response = $this->makeCall($url, ['view' => 'full']);
        return new VehicleMake($this, $response);
    }

    public function getModels($makeName, $state = null, $year = null, $submodel = null, $category = null)
    {
        $url = sprintf('/api/vehicle/v2/%s/models', $makeName);
        $params = compact('state', 'year', 'submodel', 'category') + [
            'view' => 'full'
        ];

        $response = $this->client->makeCall($url, $params);

        // return vehicle model objects for each model
        return array_map(function ($object) {
            return new VehicleModel($this, $object);
        }, $response->models);
    }

    public function getModel($makeName, $modelName)
    {
        $url = sprintf('/api/vehicle/v2/%s/%s', $makeName, $modelName);
        $response = $this->makeCall($url, ['view' => 'full']);
        return new VehicleModel($this, $response);
    }

    public function getModelYears($makeName, $modelName, $state = null, $submodel = null, $category = null)
    {
        $url = sprintf('/api/vehicle/v2/%s/%s/years', $makeName, $modelName);
        $params = compact('state', 'submodel', 'category') + [
            'view' => 'full'
        ];

        $response = $this->client->makeCall($url, $params);

        return array_map(function ($object) {
            return new VehicleModelYear($this, $object);
        }, $response->years);
    }

    public function getModelYear($makeName, $modelName, $year)
    {
        $url = sprintf('/api/vehicle/v2/%s/%s/%d', $makeName, $modelName, $year);
        $response = $this->makeCall($url, ['view' => 'full']);
        return new VehicleModelYear($this, $response);
    }

    /**
     * Gets
     *
     * @param  [type] $state    [description]
     * @param  [type] $submodel [description]
     * @param  [type] $category [description]
     * @return [type]           [description]
     */
    public function getModelStyles($makeName, $modelName, $year, $state = null, $submodel = null, $category = null)
    {
        $url = sprintf('/api/vehicle/v2/%s/%s/%d/styles', $makeName, $modelName, $year);
        $params = compact('state', 'submodel', 'category') + [
            'view' => 'full'
        ];

        $response = $this->makeCall($url, $params);

        return array_map(function ($object) {
            return new VehicleStyle($this, $object);
        }, $response->styles);
    }

    public function getModelStyle($styleId)
    {
        $url = sprintf('/api/vehicle/v2/styles/%d', $styleId);

        $response = $this->makeCall($url, ['view' => 'full']);
        return new VehicleStyle($this, $response);
    }

    public function getStylePhotos($styleId)
    {
        $response = $this->makeCall('/v1/api/vehiclephoto/service/findphotosbystyleid', [
            'styleId' => $styleId
        ]);

        return array_map(function ($object) {
            return new VehiclePhoto($this, $object);
        }, $response);
    }
}
