<?php namespace Srtfisher\Automatic\Test;

use Mockery as m;
use Srtfisher\Automatic\Error;

class ErrorTest extends \BaseTestCase
{
    /**
     * @ignore
     */
    public $error;

    public function setUp()
    {
        parent::setUp();
        $this->error = m::mock('alias:mockexception', ['getMessage' => 'Exception Message']);
    }

    public function testCreate()
    {
        $error = Error::create($this->error);

        $this->assertInstanceOf('Srtfisher\Automatic\Error', $error);
        $this->assertEquals((string) $error, '[ERROR] mockexception: Exception Message');
    }

    public function testConstruct()
    {
        $error = new Error('mockexception', 'Exception Message', $this->error);
        $this->assertEquals((string) $error, '[ERROR] mockexception: Exception Message');
    }
}
