<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 14/10/20
 * Time: 12:19
 */

namespace Chicorycom\Cigaformation\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;


class ChicorycomGuestMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(config('cigaformation.prefix'));
            }
        }

        return $next($request);
    }

}
