<?php namespace Srtfisher\Automatic\Endpoint;

use Srtfisher\Automatic\Resource\VehicleResource;
use InvalidArgumentException;

class VehicleEndpoint extends AbstractEndpoint implements EndpointInterface
{
    public $name = 'vehicles';

    public function getResource()
    {
        return new VehicleResource;
    }

    /**
     * Validate Vehicle Data
     *
     * @param string
     */
    public function validateData($data)
    {
        return true;
    }

    public function create()
    {
        throw new InvalidArgumentException('Automatic API does not support creating a vehicle via the Automatic API.');
        return null;
    }

    public function save()
    {
        throw new InvalidArgumentException('Automatic API does not support saving vehicle data via the Automatic API.');
        return null;
    }
}
