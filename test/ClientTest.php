<?php namespace Srtfisher\Automatic\Test;

class ClientTest extends \PHPUnit_Framework_TestCase
{
  public $client;

  public function setUp()
  {
    $this->client = new \Srtfisher\Automatic\Client('client id', 'client secret', 'access token');
  }

  public function testDefaultEndpoint()
  {
    $this->assertInstanceOf('Srtfisher\Automatic\Endpoint\VehicleEndpoint', $this->client->vehicles);
    $this->assertInstanceOf('Srtfisher\Automatic\Resource\VehicleResource', $this->client->vehicles->getResource());
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testMissingEndpoint()
  {
    $this->client->airplanes;
  }

  public function testClientIdSet()
  {
    $client_id = $this->client->getClientId();
    $this->client->setClientId('new client id');
    //$this->assertEquals('new client id');
  }
}
