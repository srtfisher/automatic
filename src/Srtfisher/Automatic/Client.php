<?php namespace Srtfisher\Automatic;

use Srtfisher\Automatic\Endpoint\EndpointInterface;
use Srtfisher\Automatic\Endpoint\AbstractEndpoint;
use Srtfisher\Automatic\Authentication\Manager as Authentication;
use InvalidArgumentException;

class Client
{
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
     * @var Srtfisher\Automatic\Authentication\Manager
     */
    protected $authentication;

    /**
     * @var string Access Token
     */
    protected $token;

    /**
     * @var string Redirect URI
     */
    protected $redirectUri;

    /**
     * Automatic Client Constructor
     *
     * @param    string
     * @param    string
     */
    public function __construct($clientId, $clientSecret, $token = null, $redirectUri = null)
    {
        $this->registerDefaultEndpoints();
        $this->setRedirectUri($redirectUri);

        // Request Details
        $this->setClientId($clientId);
        $this->setClientSecret($clientSecret);
        $this->setToken($token);
        $this->setAuthentication();
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
     * @return string OAuth Access Token
     */
    public function getToken()
    {
        return (string) $this->token;
    }

    /**
     * @return string OAuth Access Token
     */
    public function getRedirectUri()
    {
        return (string) $this->redirectUri;
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
     * @param string Set the Access Token
     */
    public function setToken($token)
    {
        $this->token = (string) $token;
    }

    /**
     * @param string Set the Redirect URI
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = (string) $redirectUri;
    }

    /**
     * Register the Default Endpoints of the Client
     *
     * @access protected
     */
    protected function registerDefaultEndpoints()
    {
        $this->registerEndpoint(new \Srtfisher\Automatic\Endpoint\VehicleEndpoint($this));
    }

    /**
     * Setup Authentication Manager
     *
     * @return Authentication
     */
    protected function setAuthentication()
    {
        $this->authentication = new Authentication($this);
        return $this->authentication;
    }

    /**
     * Retrieve Authentication Manager
     *
     * @return Authentication
     */
    public function getAuthentication()
    {
        return $this->authentication;
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
        if (! ($endpoint instanceof EndpointInterface)) {
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
     *     $client->vehicles->all
     *
     * @param    string Endpoint name
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
        throw new InvalidArgumentException(
            'Client does not support setting endpoint this way. '
            .'Please use "registerEndpoint".'
        );
        return null;
    }
}
