<?php namespace Srtfisher\Automatic\Test;

use Mockery as m;
use Srtfisher\Automatic\Error;
use Srtfisher\Automatic\Client;
use Srtfisher\Automatic\Requestor;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class RequestorTest extends \BaseTestCase
{
    protected $requestor;

    public function setUp()
    {
        parent::setUp();
        $this->requestor = new Requestor($this->client);

        // Attach mock requestor
        $httpClient = $this->requestor->getHttpClient();

        $stream = Stream::factory(json_encode([
            [
                    'id' => 'abcd1234',
                    'year' => 2001,
                    'make' => 'Volkswagen',
                    'model' => 'Passat',
                    'color' => '#fafafa',
                    'display_name' => 'My Passat'
            ]
        ]));

        $mock = new Mock([
            new Response(200, [], $stream)
        ]);

        $httpClient->getEmitter()->attach($mock);
        $this->requestor->setHttpClient($httpClient);
    }

    public function testAllRequest()
    {
        $request = $this->requestor->make('vehicles');
        $this->assertInstanceOf('GuzzleHttp\Message\Response', $request);
    }
}
