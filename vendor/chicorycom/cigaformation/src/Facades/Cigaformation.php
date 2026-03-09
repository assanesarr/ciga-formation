<?php

namespace Chicorycom\Cigaformation\Facades;

use Illuminate\Support\Facades\Facade;

class Cigaformation extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cigaformation';
    }
}
