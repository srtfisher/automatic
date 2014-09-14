<?php
namespace Srtfisher\Automatic\Test;

use Mockery as m;

class ClientTest extends \BaseTestCase
{
    public function testDefaultEndpoint()
    {
        $this->assertInstanceOf('Srtfisher\Automatic\Endpoint\VehicleEndpoint', $this->client->vehicles);
        $this->assertInstanceOf('Srtfisher\Automatic\Resource\Vehicle', $this->client->vehicles->getResource());
    }

    public function testRegisterEndpoint()
    {
        $mockEndpoint = m::mock('Srtfisher\Automatic\Endpoint\AbstractEndpoint', 'Srtfisher\Automatic\Endpoint\EndpointInterface');
        $mockEndpoint->name = 'mockingTest';

        // Registering the endpoint
        $this->assertInstanceOf('Srtfisher\Automatic\Client', $this->client->registerEndpoint($mockEndpoint));

        // Returns with the magic method
        $this->assertEquals($this->client->mockingTest, $mockEndpoint);
    }

    /**
    * @expectedException InvalidArgumentException
    * @expectedExceptionMessage Endpoint passed does not implement EndpointInterface interface
    */
    public function testInvalidEndpoint()
    {
        $this->client->registerEndpoint(m::mock('Srtfisher\Automatic\Endpoint\AbstractEndpoint'));
    }

    /**
    * @expectedException InvalidArgumentException
    * @expectedExceptionMessage Endpoint "airplanes" does not exist.
    */
    public function testMissingEndpoint()
    {
        $this->assertNull($this->client->airplanes);
    }

    public function testClientIdSet()
    {
        $client_id = $this->client->getClientId();
        $this->client->setClientId('new client id');
        $this->assertEquals('new client id', $this->client->getClientId());

        $this->client->setClientId('new client id');
    }

    public function testClientSecretSet()
    {
        $client_id = $this->client->getClientSecret();
        $this->client->setClientSecret('new client secret');
        $this->assertEquals('new client secret', $this->client->getClientSecret());
    }

    public function testGetToken()
    {
        $this->client->setToken('new access token');
        $this->assertEquals('new access token', $this->client->getToken());
    }

    public function testRedirectUri()
    {
        $this->client->setRedirectUri('new redirect uri');
        $this->assertEquals($this->client->getRedirectUri(), 'new redirect uri');
    }

    /**
    * @expectedException InvalidArgumentException
    * @expectedExceptionMessage Client does not support setting endpoint this way. Please use "registerEndpoint".
    */
    public function testInvalidSet()
    {
        $this->client->blimps = new \stdclass;
    }

    public function testGetAuthentication()
    {
        $this->assertInstanceOf('Srtfisher\Automatic\Authentication\Manager', $this->client->getAuthentication());
    }
}
