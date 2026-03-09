<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 19/10/20
 * Time: 18:44
 */

use Chicorycom\Cigaformation\Cigaformation;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Str;

if (! function_exists('Strlen')) {
    /**
     * @param $string
     * @param int $number
     * @return string
     */
    function Strlen($string, $number=130){

        Str::words($string, 25, '...');
        return $string;
    }
}


if (! function_exists('_asset')) {
    /**
     * @param $path
     * @param array $parameters
     * @param null $secure
     * @return string
     */
    function _asset($path, $parameters = [], $secure = null){
        return  url(config('cigaformation.assets') .'/'. $path, $parameters, $secure);
    }
}

if (! function_exists('_asset')) {
    /**
     * @param $path
     * @param array $parameters
     * @param null $secure
     * @return string
     */
    function _url($path, $parameters = [], $secure = null){
        return  url(config('cigaformation.assets') .'/'. $path, $parameters, $secure);
    }
}

if (! function_exists('_mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @return \Illuminate\Support\HtmlString|string
     *
     * @throws \Exception
     */
    function _mix($path)
    {
        $asset = config('cigaformation.assets') ;
        $path = $asset . '/' . $path;
        $manifestDirectory = $asset;
       // dd($path);
        return app(Cigaformation::class)->mix($path, $manifestDirectory);
    }
}
