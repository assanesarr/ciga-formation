<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 21/10/20
 * Time: 12:57
 */

namespace Chicorycom\Cigaformation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class ChicorycomPublishedProvider extends ServiceProvider
{


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {


        if ($this->app->runningInConsole()) {
           // $this->registerPublishableResources();
        }

    }
        /**
         * Register the publishable files.
         */
        private function registerPublishableResources(){

        $publishablePath = __DIR__.'/..';

        $publishable = [
            'assets' => [
                "{$publishablePath}/public" => public_path(''),
            ]
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
}
