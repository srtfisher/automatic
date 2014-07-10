<?php namespace Srtfisher\Automattic;

use Srtfisher\Automatic\Endpoint\EndpointInterface;
use Srtfisher\Automatic\Endpoint\AbstractEndpoint;
use InvalidArgumentException;

class Client {
  /**
   * Endpoints
   *
   * @type Array
   */
  protected $endpoints = [];

  /**
   * @var string Automatic API Basic URL
   */
  public static $apiBase = 'https://api.automatic.com/v1/';

  /**
   * @var string OAuth 2 Client ID
   */
  protected $clientId;

  /**
   * @var string OAuth 2 Client Secret
   */
  protected $clientSecret;

  /**
   * Automatic Client Constructor
   *
   * @param  string
   * @param  string
   */
  public function __construct($clientId, $clientSecret)
  {
    $this->registerDefaultEndpoints();

    $this->setClientId($clientId);
    $this->clientSecret($clientSecret);
  }

  /**
   * @return OAuth Client ID
   */
  public function getClientId()
  {
    return $this->clientId;
  }

  /**
   * @return OAuth Client Secret
   */
  public function getClientSecret()
  {
    return $this->clientSecret;
  }

  /**
   * @param string Set the Client ID
   */
  public function setClientId($clientId)
  {
    $this->clientId = (string) $clientId;
  }

  /**
   * @param string Set the Client Secret
   */
  public function setClientSecret($clientSecret)
  {
    $this->clientSecret = (string) $clientSecret;
  }

  /**
   * Register the Default Endpoints of the Client
   *
   * @access protected
   */
  protected function registerDefaultEndpoints()
  {
    $this->registerEndpoint(new Srtfisher\Automatic\Endpoint\Vehicle);
  }

  /**
   * Register a Resource Provider
   *
   * @param AbstractEndpoint
   * @throws InvalidArgumentException
   * @return Client
   */
  public function registerEndpoint(AbstractEndpoint $endpoint)
  {
    if (! ($resource instanceof EndpointInterface)) {
      throw new InvalidArgumentException('Endpoint passed does not implement EndpointInterface interface');
    }

    $this->endpoints[$endpoint->name] = $endpoint;
    return $this;
  }

  /**
   * Endpoint Catcher
   *
   * Accessible catcher
   *
   *   $client->vehicles->all
   *
   * @param  string Endpoint name
   * @return AbstractEndpoint|void
   */
  public function __get($endpoint)
  {
    if (! isset($this->endpoints[$endpoint])) {
      throw new InvalidArgumentException(sprintf('Endpoint "%s" does not exist.', $endpoint));
      return null;
    } else {
      return $this->endpoints[$endpoint];
    }
  }

  /**
   * Invalid Argument Catcher
   *
   * To register an endpoint, use `registerEndpoint`
   */
  public function __set($name, $value)
  {
    throw new InvalidArgumentException('Client does not support setting endpoint this way. Please use "registerEndpoint".');
    return null;
  }
}
