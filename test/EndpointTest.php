<?php
namespace Srtfisher\Automatic\Test;

use Mockery as m;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class EndpointTest extends \BaseTestCase
{
    public function testRetrieve()
    {
        // Make a clone for this test
        $client = clone $this->client;

        // Change the http client to mock response
        $httpClient = $client->getRequestor()->getHttpClient();
        $stream = Stream::factory(json_encode([
            'id' => 'abcd1234',
            'year' => 2001,
            'make' => 'Volkswagen',
            'model' => 'Passat',
            'color' => '#fafafa',
            'display_name' => 'My Passat'
        ]));

        $mock = new Mock([
            new Response(200, [], $stream)
        ]);

        $httpClient->getEmitter()->attach($mock);

        // Built the response, make the request and see the response
        $vehicle = $client->vehicles->retrieve('abcd1234');
        $this->assertInstanceOf('Srtfisher\Automatic\Resource\Vehicle', $vehicle);
    }
}
