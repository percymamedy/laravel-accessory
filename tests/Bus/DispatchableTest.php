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
}
