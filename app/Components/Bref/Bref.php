<?php

namespace App\Components\Bref;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void run(callable $callback)
 */
class Bref extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Lambda::class;
    }
}
