<?php namespace Srtfisher\Automatic\Authentication;

use League\OAuth2\Client\Provider\AbstractProvider;
use Srtfisher\Automtic\Client;
use League\OAuth2\Client\Entity\User;

class AutomaticProvider extends AbstractProvider
{
    public $scopes = [
        'scope:location',
        'scope:vehicle',
        'scope:trip:summary',
        'scope:ignition:on',
        'scope:ignition:off',
        // 'scope:notification:speeding',
        // 'scope:notification:hard_brake',
        // 'scope:notification:hard_accel',
        // 'scope:notification:stopped',
        // 'scope:region:changed',
        // 'scope:parking:changed',
        // 'scope:mil:on',
        // 'scope:mil:of',
    ];

    public $responseType = 'json';
    public $scopeSeparator = ' ';

    public function urlAuthorize()
    {
        return 'https://www.automatic.com/oauth/authorize';
    }

    public function urlAccessToken()
    {
        return 'https://www.automatic.com/oauth/access_token';
    }

    public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return Client::$apiBase.'user?access_token='.$token;
    }

    public function userDetails($response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        $user = new User;

        $user->exchangeArray([
            'uid' => $response->id,
        ]);

        return $user;
    }
}
