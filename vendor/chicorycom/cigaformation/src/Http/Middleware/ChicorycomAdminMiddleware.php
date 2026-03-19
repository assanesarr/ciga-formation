<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 29/09/20
 * Time: 12:53
 */

namespace Chicorycom\Cigaformation\Http\Middleware;


use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ChicorycomAdminMiddleware extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if (! $request->expectsJson()) {
            return route('chicorycom.login');
        }
    }
}
