<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 29/09/20
 * Time: 14:54
 */

namespace Chicorycom\Cigaformation\Traits;

trait Seedable
{
    public function seed($class)
    {
        if (!class_exists($class)) {
            require_once $this->seedersPath.$class.'.php';
        }

        with(new $class())->run();
    }
}
