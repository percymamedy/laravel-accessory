<?php

namespace Accessory\Tests\Bus;

use Mockery as m;
use Orchestra\Testbench\TestCase;
use Accessory\Tests\Fixtures\ProcessPodcast;

class DispatchableTest extends TestCase
{
    /**
     * Test dispatchNow method on Dispatchable trait is able to
     * construct a Job and dispatch it immediately.
     *
     * @return void
     */
    public function testDispatchNowMethodDispatchesTheJobImmediately()
    {
        $podcast = m::mock('App\Podcast');
        $audioProcessor = m::mock('App\AudioProcessor');

        $audioProcessor->shouldReceive('processPodcast')
                       ->with($podcast)
                       ->andReturn(true);

        $this->app->instance('App\AudioProcessor', $audioProcessor);

        $result = ProcessPodcast::dispatchNow($podcast);

        $this->assertTrue($result);
    }

    /**
     * Test that the when method on the Dispatchable probler
     *
     * @return void
     */
    public function testWhenMethodProperlyCreatesTheRegulatorCorrectly()
    {
        $podcast = m::mock('App\Podcast');
        $audioProcessor = m::mock('App\AudioProcessor');
    

        $audioProcessor->shouldReceive('processPodcast')
                       ->with($podcast)
                       ->andReturn(true);

        $this->app->instance('App\AudioProcessor', $audioProcessor);

        $regulator1 = ProcessPodcast::when(true);

        $determinant1 = (new \ReflectionClass($regulator1))->getProperty('determinant');
        $determinant1->setAccessible(true);
        $this->assertTrue($determinant1->getValue($regulator1));

        $subject1 = (new \ReflectionClass($regulator1))->getProperty('subject');
        $subject1->setAccessible(true);
        $this->assertEquals(ProcessPodcast::class, $subject1->getValue($regulator1));


        $regulator2 = ProcessPodcast::when(function () {
            return false;
        });

        $determinant2 = (new \ReflectionClass($regulator2))->getProperty('determinant');
        $determinant2->setAccessible(true);
        $this->assertFalse($determinant2->getValue($regulator2));

        $subject2 = (new \ReflectionClass($regulator2))->getProperty('subject');
        $subject2->setAccessible(true);
        $this->assertEquals(ProcessPodcast::class, $subject1->getValue($regulator2));
    }
}
