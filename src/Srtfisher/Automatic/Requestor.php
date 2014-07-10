<?php namespace Srtfisher\Automatic;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use Exception;

class Requestor {
  /**
   * Client Instance
   *
   * @var Client
   */
  protected $client;

  /**
   * Request Constructor
   *
   * @param  Client
   */
  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  /**
   * Make a Request
   *
   * @param  string API Endpoint
   * @param  string HTTP Method
   * @param  array Parameters to pass
   * @return resource
   */
  public function make($location, $method = 'GET', $params = [], $headers = [])
  {
    $guzzle = new GuzzleClient(['base_url' => Client::$apiBase]);

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
      return $guzzle->$method($location, $options);
    } catch (ClientErrorResponseException $e) {
      return Error::create($e);
    } catch (ServerException $e) {
      return Error::create($e);
    } catch (Exception $e) {
      return Error::create($e);
    }
  }
}
