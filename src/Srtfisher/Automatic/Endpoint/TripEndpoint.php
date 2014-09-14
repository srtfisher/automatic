<?php
namespace Srtfisher\Automatic\Endpoint;

use Srtfisher\Automatic\Resource\Trip as TripResource;
use InvalidArgumentException;

class TripEndpoint extends AbstractEndpoint implements EndpointInterface
{
    public $name = 'trips';

    public function getResource()
    {
        return new TripResource;
    }

    /**
     * Validate Trip Data
     *
     * @param string
     */
    public function validateData($data)
    {
        return true;
    }

    public function create()
    {
        throw new InvalidArgumentException('Automatic API does not support creating a trip via the Automatic API.');
        return null;
    }

    public function save()
    {
        throw new InvalidArgumentException('Automatic API does not support saving trip data via the Automatic API.');
        return null;
    }
}
