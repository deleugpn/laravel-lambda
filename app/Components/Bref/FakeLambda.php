<?php

namespace App\Components\Bref;

use App\Components\Bref\Contracts\LambdaProcessor;
use Bref\Context\Context;

class FakeLambda implements LambdaProcessor
{
    private $event;

    private $context;

    public function __construct(array $event, ?Context $context = null)
    {
        $this->event = $event;
        $this->context = $context;
    }

    public function run(callable $callback): void
    {
        $callback($this->event, $this->context);
    }
}
