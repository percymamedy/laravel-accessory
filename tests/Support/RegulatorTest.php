<?php

namespace Accessory\Tests\Support;

use Mockery as m;
use Orchestra\Testbench\TestCase;
use Accessory\Tests\Fixtures\ProcessPodcast;

class RegulatorTest extends TestCase
{
    /**
     * Test that the Regulator delegates the method call directly
     * on the Subject instance determined by the determinant.
     *
     * @return void
     */
    public function testDelegationProperlyDeterminedByDeterminant()
    {
        $podcast = m::mock('App\Podcast');
        $audioProcessor = m::mock('App\AudioProcessor');

        $audioProcessor->shouldReceive('processPodcast')
                       ->with($podcast)
                       ->andReturn(true);

        $this->app->instance('App\AudioProcessor', $audioProcessor);

        $result1 = ProcessPodcast::when(true)->dispatchNow($podcast);
        $this->assertTrue($result1);

        $result2 = ProcessPodcast::when(false)->dispatchNow($podcast);
        $this->assertNull($result2);
    }
}
