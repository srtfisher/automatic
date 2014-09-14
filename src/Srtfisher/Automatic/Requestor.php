<?php
namespace Srtfisher\Automatic;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use Exception;

class Requestor
{
    /**
     * Client Instance
     *
     * @var Client
     */
    protected $client;

    /**
     * Guzzle Instance
     *
     * @var GuzzleClient
     */
    protected $httpClient;

    /**
     * Request Constructor
     *
     * @param    Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->setHttpClient(new GuzzleClient([
            'base_url' => Client::$apiBase,
            'defaults' => [
                'verify' => false
            ]
        ]));
    }

    /**
     * Make a Request
     *
     * @param    string API Endpoint
     * @param    string HTTP Method
     * @param    array Parameters to pass
     * @return resource
     */
    public function make($location, $method = 'GET', $params = [], $headers = [])
    {
        $options = [];

        switch (strtoupper($method)) {
            case 'GET':
                $options['query'] = $params;
                break;

            case 'POST':
            case 'PUT':
            case 'PATCH':
                $options['body'] = $params;
                break;
        }

        $options['headers'] = $headers;
        $options['headers']['Authorization'] = 'token '.$this->client->getToken();

        try {
            return $this->getHttpClient()->$method($location, $options);
        } catch (ClientErrorResponseException $e) {
            return Error::create($e);
        } catch (ServerException $e) {
            return Error::create($e);
        } catch (Exception $e) {
            return Error::create($e);
        }
    }

    /**
     * Set HTTP Client
     *
     * @param GuzzleClient
     */
    public function setHttpClient(GuzzleClient $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * Retrieve HTTP Client
     *
     * @return GuzzleClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }
}
