<?php

namespace App\Modules\Background;

use App\Modules\Background\Jobs\BackgroundJob;
use Illuminate\Contracts\Bus\QueueingDispatcher;

class BackgroundHandler
{
    private $dispatcher;

    public function __construct(QueueingDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function __invoke()
    {
        $this->dispatcher->dispatchToQueue(new BackgroundJob());

        return response('', 200);
    }
}
