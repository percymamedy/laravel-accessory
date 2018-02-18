<?php

namespace Accessory\Support;

trait Makable
{
    /**
     * Makes a new instance of the
     * object.
     *
     * @param array ...$args
     *
     * @return static
     */
    public static function make(...$args)
    {
        // No arguments passed to make.
        if (func_num_args() === 0) {
            return new static();
        }

        return new static(...$args);
    }
}
