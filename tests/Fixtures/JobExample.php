<?php

namespace Accessory\Tests\Fixtures;

use Accessory\Support\Makable;

class JobExample
{
    use Makable;

    /**
     * Dummy Job Data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Job name
     *
     * @var string
     */
    protected $jobName = null;

    /**
     * Job constructor.
     *
     * @param string $jobName
     * @param array  $data
     */
    public function __construct($jobName, array $data)
    {
        $this->jobName = $jobName;
        $this->data = $data;
    }

    /**
     * Get JobName.
     *
     * @return string
     */
    public function getJobName()
    {
        return $this->jobName;
    }

    /**
     * Get JobData.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
