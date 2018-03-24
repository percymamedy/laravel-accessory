<?php

namespace Accessory\Bus;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable as BaseDispatchable;
use Accessory\Support\Regulator;

trait Dispatchable
{
    use BaseDispatchable;

    /**
     * Dispatch the current job to its appropriate handler in the current process.
     *
     * @return mixed
     */
    public static function dispatchNow()
    {
        return app(Dispatcher::class)->dispatchNow(new static(...func_get_args()));
    }

    /**
     * Creates a Regulator for the Job.
     *
     * @param \Closure|bool $callback
     *
     * @return \Accessory\Support\Regulator
     */
    public static function when($callback)
    {
        return Regulator::make(self::class, $callback instanceof \Closure ? $callback() : $callback);
    }
}
