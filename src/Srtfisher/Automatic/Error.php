<?php namespace Srtfisher\Automatic;

/**
 * Error Object
 *
 * Returned in the event of an error
 */
class Error {
  protected $type;
  protected $message;
  protected $exception;

  public function __construct($type, $message, $exception)
  {
    $this->type = $type;
    $this->message = $message;
    $this->exception = $exception;
  }

  public function __toString()
  {
    return sprintf('[ERROR] %s: %s', $type, $message);
  }

  public static function create($exception)
  {
    return new Error(get_class($exception), $exception->getMessage(), $exception);
  }
}
