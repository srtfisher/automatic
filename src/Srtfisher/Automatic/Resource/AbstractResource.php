<?php namespace Srtfisher\Automatic\Resource;

use Srtfisher\Automatic\Resource\AbstractEndpoint;
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
  public function __construct($data, AbstractEndpoint $endpoint)
  {
    $this->originals = $this->items = $data;
    $this->endpoint = $endpoint;
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
