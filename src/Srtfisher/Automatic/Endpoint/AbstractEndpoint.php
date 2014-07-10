<?php namespace Srtfisher\Automatic\Endpoint;

use Illuminate\Support\Collection;
use Srtfisher\Automatic\Requestor;
use Srtfisher\Automatic\Client;

abstract class AbstractEndpoint {
  /**
   * Name of the Endpoint
   */
  public $name;

  /**
   * Client Instance
   *
   * @type Client
   */
  protected $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  /**
   * Retrieve all results inside resource
   *
   * @return Collection Array of record
   */
  public function all($params = [])
  {
    return $this->requestor()->make($this->buildResourceUrl(), 'GET', $params);
  }

  /**
   * Create a new Resource Object
   *
   * Only returns a new object, does not save it to the API
   *
   * @return Srtfisher\Automatic\Resource\AbstractResource
   */
  public function create()
  {
    return $this->getResource();
  }

  /**
   * Retrieve a Single Resource
   */
  public function retrieve($resource_id)
  {
    return $this->requestor()->make($this->buildResourceUrl($resource_id), 'GET', $params);
  }

  /**
   * Requestor Instance
   *
   * @return Requestor
   */
  protected function requestor()
  {
    return new Requestor($this->client);
  }

  /**
   * Build the URL to a Resource, be it a base or a sub resource
   *
   * Subresources will extend this method and implement a subresource url
   *
   * @return string
   */
  protected function buildResourceUrl($add = '')
  {
    return $this->name.'/'.$add;
  }
}
