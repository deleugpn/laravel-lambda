<?php

namespace App\Components\Bref;

use App\Components\Bref\Contracts\LambdaProcessor;

class Lambda implements LambdaProcessor
{
    public function run(callable $callback): void
    {
        lambda($callback);
    }
}
