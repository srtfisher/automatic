<?php namespace Srtfisher\Automatic\Endpoint;

use Illuminate\Support\Collection;

abstract class AbstractResource {
  protected $name;

  /**
   * Retrieve all results inside resource
   *
   * @return Collection Array of record
   */
  public function all()
  {
    
  }

  public function create()
  {

  }

  /**
   * Retrieve a Single Resource
   */
  public function retrieve($resource_id)
  {

  }

  public function update($resource_id)
  {

  }

  public function destroy($resource_id)
  {

  }
}
