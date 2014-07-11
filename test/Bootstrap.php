<?php
if ( ! @include_once __DIR__ . '/../vendor/autoload.php') {
    exit("You must set up the project dependencies, run the following commands:\n> wget http://getcomposer.org/composer.phar\n> php composer.phar install\n");
}

use \Mockery as m;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
  public $client;

  public function setUp()
  {
    $this->client = new \Srtfisher\Automatic\Client('client id', 'client secret', 'access token', 'http://localhost/');
  }

  public function tearDown()
  {
    m::close();
  }
}
