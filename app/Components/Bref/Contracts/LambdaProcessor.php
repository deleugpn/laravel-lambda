<?php

namespace App\Components\Bref\Contracts;

interface LambdaProcessor
{
    public function run(callable $callback): void;
}