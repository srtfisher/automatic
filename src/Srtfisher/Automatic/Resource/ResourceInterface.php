<?php namespace Srtfisher\Automatic\Resource;

interface ResourceInterface {
  public function getResourceId();
  public function setResourceId($resource_id);
  public static function createFromResponse($data);
}
