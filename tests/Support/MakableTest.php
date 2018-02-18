<?php

namespace Accessory\Tests\Support;

use Orchestra\Testbench\TestCase;
use Accessory\Tests\Fixtures\JobExample;

class MakableTest extends TestCase
{
    /**
     * Test make method on Makable trait is able to
     * construct an Object.
     *
     * @return void
     */
    public function testMakeMethodConstructsTheObject()
    {
        $jobName = 'Simple Job';
        $data = [1, 2, 3];
        $job = JobExample::make('Simple Job', $data);

        $this->assertInstanceOf(JobExample::class, $job);
        $this->assertEquals($jobName, $job->getJobName());
        $this->assertEquals($data, $job->getData());
    }
}
