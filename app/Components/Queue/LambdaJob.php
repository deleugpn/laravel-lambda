<?php

namespace App\Components\Queue;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Queue\Job as JobContract;
use Illuminate\Queue\Jobs\Job;

class LambdaJob extends Job implements JobContract
{
    private $job;

    public function __construct(Container $container, array $job)
    {
        $this->job = $job;
        $this->container = $container;
        $this->connectionName = 'lambda';
    }

    public function getJobId()
    {
        return $this->job['messageId'];
    }

    public function getRawBody()
    {
        return $this->job['body'];
    }

    public function attempts()
    {
        return (int)$this->job['attributes']['ApproximateReceiveCount'];
    }
}