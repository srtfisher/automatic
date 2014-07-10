<?php namespace Srtfisher\Automattic;

class Client {
  /**
   * @var string Automatic API Basic URL
   */
  public static $apiBase = 'https://api.automatic.com/v1/';

  /**
   * @var string OAuth 2 Client ID
   */
  protected static $clientId;

  /**
   * @var string OAuth 2 Client Secret
   */
  protected static $clientSecret;

  /**
   * @return OAuth Client ID
   */
  public function getClientId()
  {
    return self::$clientId;
  }

  /**
   * @return OAuth Client Secret
   */
  public function getClientSecret()
  {
    return self::$clientSecret;
  }

  /**
   * @param string Set the Client ID
   */
  public function setClientId($clientId)
  {
    self::$clientId = (string) $clientId;
  }

  /**
   * @param string Set the Client Secret
   */
  public function setClientSecret($clientSecret)
  {
    self::$clientSecret = (string) $clientSecret;
  }
}
