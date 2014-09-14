<?php
namespace Srtfisher\Automatic\Test\Authentication;

use Mockery as m;
use Srtfisher\Automatic\Error;
use Srtfisher\Automatic\Client;
use Srtfisher\Automatic\Authentication\AutomaticProvider;
use Srtfisher\Automatic\Requestor;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class ProviderTest extends \BaseTestCase
{
    protected $provider;

    public function setUp()
    {
        parent::setUp();
        $this->provider = new AutomaticProvider;
    }

    public function testUrlUserDetails()
    {
        $token = m::mock('League\OAuth2\Client\Token\AccessToken');
        $token->shouldReceive('__toString')
            ->andReturn('TOKEN');

        $userDetails = $this->provider->urlUserDetails($token);

        $this->assertEquals('https://api.automatic.com/v1/user?access_token=TOKEN', $userDetails);
    }

    public function testUserDetails()
    {
        $token = m::mock('League\OAuth2\Client\Token\AccessToken');
        $response = (object) ['id' => 'abdc1234'];
        $details = $this->provider->userDetails($response, $token);

        $this->assertObjectHasAttribute('uid', $details);
        $this->assertEquals('abdc1234', $details->uid);
    }
}
