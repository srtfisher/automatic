<?php namespace Srtfisher\Automatic\Resource;

use Srtfisher\Automatic\Endpoint\AbstractEndpoint;
use InvalidArgumentException;
use ArrayAccess;

abstract class AbstractResource implements ArrayAccess {
  /**
   * Items Storage
   *
   * @var Array
   */
  protected $items;

  /**
   * Original Items State
   *
   * @var Collection
   */
  protected $originals;

  /**
   * Endpoint Resource
   *
   * @var AbstractEndpoint
   */
  protected $endpoint;

  /**
   * Construct a new Resource
   *
   * @param  Array
   */
  public function __construct($data = [], AbstractEndpoint $endpoint = null)
  {
    $this->fill($data);

    if ($endpoint) $this->setEndpoint($endpoint);
  }

  /**
   * Set the Endpoint Resource
   *
   * @param AbstractEndpoint
   */
  public function setEndpoint(AbstractEndpoint $endpoint = null)
  {
    $this->endpoint = $endpoint;
    return $this;
  }

  /**
   * Fill in Data
   *
   * @param  Array
   * @return AbstractResource
   */
  public function fill($data = [])
  {
    $this->originals = $this->items = $data;
    return $this;
  }

  /**
   * Create a Resource from data static
   *
   * @param Array
   * @return AbstractResource
   */
  public static function create($data, AbstractEndpoint $endpoint)
  {
    $object = new self($datam, $endpoint);
    return $object;
  }

  /**
   * Save the Resource
   *
   * @return AbstractResource
   */
  public function save()
  {
    return $this;
  }

  /**
   * Destroy the Resource
   *
   * @return Object Response
   */
  public function destroy()
  {

  }

  /**
   * @return boolean
   */
  public function isNewResource()
  {
    $resource_id = $this->getResourceId();
    return (is_null($resource_id) || ! $resource_id);
  }

  /**
   * Retrieve the Resource Identifier
   *
   * @return integer|string
   */
  public function getResourceId()
  {
    return $this->id;
  }

  /**
   * Set the Resource Identifier
   *
   * @param string|integer
   * @return AbstractResource
   */
  public function setResourceId($resource_id)
  {
    $this->id = $resource_id;
    return $this;
  }

  /**
   * Reset the Resource to its loaded state
   *
   * @return AbstractResource
   */
  public function reset()
  {
    $this->items = $this->originals;
    return $this;
  }

  /**
   * Helper method to retrieve object data
   *
   * @return mixed
   */
  public function __get($key)
  {
    if (array_key_exists($key, $this->items)) {
      return $this->items[$key];
    } else {
      throw new InvalidArgumentException(sprintf('Data value "%s" does not exist for resource', $key));
      return null;
    }
  }

  /**
   * Set the object data
   */
  public function __set($key, $value)
  {
    $this->items[$key] = $value;
  }

  // ArrayAccess methods
  public function offsetSet($key, $value)
  {
    $this->$key = $value;
  }

  public function offsetExists($key)
  {
    return array_key_exists($key, $this->items);
  }

  public function offsetUnset($key)
  {
    unset($this->$key);
  }

  public function offsetGet($k)
  {
    return array_key_exists($key, $this->items) ? $this->items[$key] : null;
  }

  public function __isset($key)
  {
    return isset($this->items[$key]);
  }

  public function __unset($key)
  {
    unset($this->items[$key]);
  }

  public function keys()
  {
    return array_keys($this->items);
  }
}
