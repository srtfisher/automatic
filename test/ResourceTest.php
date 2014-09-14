<?php
namespace Srtfisher\Automatic\Test;

use Mockery as m;
use Srtfisher\Automatic\Resource\Vehicle;

class ResourceTest extends \BaseTestCase
{
    public function testCreate()
    {
        $vehicle = Vehicle::create([
            'name' => 'abcd1234'
        ], new \Srtfisher\Automatic\Endpoint\VehicleEndpoint($this->client));

        $this->assertInstanceOf('Srtfisher\Automatic\Resource\Vehicle', $vehicle);
        $this->assertEquals('abcd1234', $vehicle->name);
        $this->assertTrue($vehicle->isNewResource());

        $vehicle->setto = 'apple';
        $this->assertEquals($vehicle->setto, 'apple');

        $this->assertFalse(isset($vehicle['unknown']));
        $this->assertTrue(isset($vehicle['name']));

        $vehicle->setResourceId('ID');
        $this->assertEquals('ID', $vehicle->getResourceId());
        $this->assertEquals('ID', $vehicle->id);
    }

    public function testReset()
    {
        $vehicle = Vehicle::create([
            'name' => 'abcd1234'
        ], new \Srtfisher\Automatic\Endpoint\VehicleEndpoint($this->client));

        $this->assertEquals($vehicle->name, 'abcd1234');
        $vehicle->name = 'newname';
        $this->assertEquals($vehicle->name, 'newname');

        // Reset the data
        $vehicle->reset();

        $this->assertEquals($vehicle->name, 'abcd1234');
    }
}
