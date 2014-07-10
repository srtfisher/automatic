<?php namespace Srtfisher\Automatic\Authentication;

use Srtfisher\Automatic\Client;
use League\OAuth2\Client\Token\AccessToken;

/**
 * Authentication Manager
 *
 * @package automatic
 */
class Manager
{
  /**
   * @type Srtfisher\Automatic\Client
   */
  protected $client;

  /**
   * @type string
   */
  protected $redirectUri;

  /**
   * @type string Access Token
   */
  protected $token;

  public function __construct(Client $client, $token, $redirectUri = null)
  {
    $this->client = $client;
    $this->token = (string) $token;
    $this->redirectUri = $redirectUri;
  }

  /**
   * Retrieve the Authorization URL
   *
   * @return string
   */
  public function getAuthorizationUrl()
  {
    return $this->getProvider()->getAuthorizationUrl();
  }

  /**
   * Get a Access Token from an Access Code
   *
   * Save this token for future use
   *
   * @param string
   * @return League\OAuth2\Client\Token\AccessToken
   */
  public function getAccessToken($code)
  {
    $token = (string) $this->getProvider()->getAccessToken('authorization_code', [
      'code' => $code
    ]);

    $this->token = (string) $token;

    return $token;
  }

  /**
   * Set the Access Token
   *
   * @param string
   */
  public function setAccessToken($token)
  {
    $this->token = (string) $token;
  }

  /**
   * Refresh the Access Token
   *
   * @param string Refresh Token
   * @return League\OAuth2\Client\Token\AccessToken
   */
  public function refreshToken($refreshToken)
  {
    $provider = $this->getProvider();
    $grant = new \League\OAuth2\Client\Grant\RefreshToken;
    $token = $provider->getAccessToken($grant, ['refresh_token' => $refreshToken]);

    $this->token = (string) $token;

    return $token;
  }

  /**
   * Retrieve User Details
   */

  public function getProvider()
  {
    return new AutomaticProvider([
      'clientId' => $client->getClientId(),
      'clientSecret' => $client->getClientSecre(),
      'redirectUri' => $this->redirectUri
    ]);
  }
}
