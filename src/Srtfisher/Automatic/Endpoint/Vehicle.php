<?php namespace Srtfisher\Automatic\Endpoint;

use Srtfisher\Automatic\Resource\VehicleResource;

class Vehicle extends AbstractEndpoint {
  protected $name = 'vehicles';

  public function getResource()
  {
    return new VehicleResource;
  }
}
