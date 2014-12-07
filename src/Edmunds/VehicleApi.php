<?php
namespace CarRived\Edmunds;

class VehicleApi extends RemoteObject
{
    const STATE_NEW = 'new';
    const STATE_USED = 'used';
    const STATE_FUTURE = 'future';

    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Gets a make object by name.
     *
     * @param  [type] $name  [description]
     * @param  [type] $state [description]
     * @param  [type] $year  [description]
     * @return [type]        [description]
     */
    public function getMake($name, $state = null, $year = null)
    {
        $url = sprintf('/api/vehicle/v2/%s', $name);
        $params = compact('state', 'year') + [
            'view' => 'full'
        ];

        $response = $this->client->makeCall($url, $params);
        return new VehicleMake($this->client, $response);
    }

    public function getMakes($state = null, $year = null)
    {
        $params = compact('state', 'year') + [
            'view' => 'full'
        ];

        $response = $this->client->makeCall('/api/vehicle/v2/makes', $params);

        // return vehicle make objects for each make found
        return array_map(function ($make) {
            return new VehicleMake($this->client, $make);
        }, $response->makes);
    }

    public function getStyle($id)
    {
        $url = sprintf('/api/vehicle/v2/styles/%d', $id);

        $response = $this->client->makeCall($url, ['view' => 'full']);
        return new VehicleStyle($this->client, $response);
    }
}
