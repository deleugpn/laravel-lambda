<?php

namespace App\Components\Queue;

use App\Components\Bref\Bref;
use Illuminate\Queue\Console\WorkCommand;

class LambdaWorkCommand extends WorkCommand
{
    protected $signature = 'queue:lambda
                            {connection? : The name of the queue connection to work}
                            {--queue= : The names of the queues to work}
                            {--daemon : Run the worker in daemon mode (Deprecated)}
                            {--once : Only process the next job on the queue}
                            {--stop-when-empty : Stop when the queue is empty}
                            {--delay=0 : The number of seconds to delay failed jobs}
                            {--force : Force the worker to run even in maintenance mode}
                            {--memory=128 : The memory limit in megabytes}
                            {--sleep=3 : Number of seconds to sleep when no job is available}
                            {--timeout=60 : The number of seconds a child process can run}
                            {--tries=0 : Number of times to attempt a job before logging it failed}';

    protected function runWorker($connection, $queue)
    {
        $this->worker->setCache($this->laravel['cache']->driver());

        Bref::run(function (array $event) {
            $job = new LambdaJob($this->laravel, $event['Records'][0]);

            $this->worker->process('lambda', $job, $this->gatherWorkerOptions());
        });
    }
}