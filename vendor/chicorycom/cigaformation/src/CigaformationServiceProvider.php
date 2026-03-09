<?php

namespace Chicorycom\Cigaformation;



use Chicorycom\Cigaformation\Http\Middleware\ChicorycomAdminMiddleware;
use Chicorycom\Cigaformation\Http\Middleware\ChicorycomGuestMiddleware;
use Chicorycom\Cigaformation\View\Components\Events;
use Chicorycom\Cigaformation\View\Components\ModulaireFormation;
use Chicorycom\Cigaformation\View\Components\Slide;
use Chicorycom\Cigaformation\View\Components\TopCourses;
use HTMLMin\HTMLMin\Facades\HTMLMin;
use Chicorycom\Cigaformation\Facades\Cigaformation as CigaformationFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;

class CigaformationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('chicorycomguest', ChicorycomGuestMiddleware::class);
        $router->aliasMiddleware('chicorycom', ChicorycomAdminMiddleware::class);

        $router->prefix(config('cigaformation.prefix'))
            ->middleware('api')
            ->as('chicorycom.')
            ->namespace('Chicorycom\Cigaformation\Http\Controllers\Admin')
            ->group(__DIR__.'/../routes/admin.php');

         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'chicorycom');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'chicorycom');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewComponentsAs('chicorycom', [
            Slide::class,
            TopCourses::class,
            ModulaireFormation::class,
            Events::class
        ]);

        if (!file_exists(public_path('storage'))) {
            $this->fixMissingStorageSymlink();
        }
    }

    /**
     * Add storage symlink alert.
     */
    protected function addStorageSymlinkAlert()
    {
        if (app('router')->current() !== null) {
            $currentRouteAction = app('router')->current()->getAction();
        } else {
            $currentRouteAction = null;
        }
        $routeName = is_array($currentRouteAction) ? Arr::get($currentRouteAction, 'as') : null;

        if ($routeName != 'chicorycom.dashboard') {
            return;
        }

        $storage_disk = (!empty(config('cigaformation.storage.disk'))) ? config('cigaformation.storage.disk') : 'public';

        if (request()->has('fix-missing-storage-symlink')) {
            if (file_exists(public_path('storage'))) {
                if (@readlink(public_path('storage')) == public_path('storage')) {
                    rename(public_path('storage'), 'storage_old');
                }
            }

            if (!file_exists(public_path('storage'))) {
                $this->fixMissingStorageSymlink();
            }
        } elseif ($storage_disk == 'public') {
            if (!file_exists(public_path('storage')) || @readlink(public_path('storage')) == public_path('storage')) {
               /* $alert = (new Alert('missing-storage-symlink', 'warning'))
                    ->title(__('voyager::error.symlink_missing_title'))
                    ->text(__('voyager::error.symlink_missing_text'))
                    ->button(__('voyager::error.symlink_missing_button'), '?fix-missing-storage-symlink=1');
                VoyagerFacade::addAlert($alert); */
            }
        }
    }

    protected function fixMissingStorageSymlink()
    {
        app('files')->link(storage_path('app/public'), public_path('storage'));

        if (file_exists(public_path('storage'))) {

        } else {

        }


    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->register(ChicorycomPublishedProvider::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('HTMLMin', HTMLMin::class);
        $loader->alias('Cigaformation', CigaformationFacade::class);

        $this->mergeConfigFrom(__DIR__.'/../config/cigaformation.php', 'cigaformation');

        // Register the service the package provides.
        $this->app->singleton('cigaformation', function () {
            return new Cigaformation;
        });

        $this->app->singleton('ChicorycomGuard', function () {
            return config('auth.defaults.guard', 'api');
        });


        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }

        if (!$this->app->runningInConsole() || config('app.env') == 'testing') {
            $this->registerAppCommands();
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cigaformation'];
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
        $this->commands(Commands\AssetPublished::class);
        $this->commands(Commands\ControllersCommand::class);
        $this->commands(Commands\AdminCommand::class);
    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $publishablePath = __DIR__.'/..';
        $publishable = [
           /* 'assets' => [
                "{$publishablePath}/public" => public_path(''),
            ],
            'seeders' => [
                "{$publishablePath}/database/seeders" => database_path('seeders'),
            ],*/
            'config' => [
                "{$publishablePath}/config/cigaformation.php" => config_path('cigaformation.php'),
            ],
            'htmlmin' => [
                "{$publishablePath}/config/htmlmin.php" => config_path('htmlmin.php'),
            ]

        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

/**
* Register the commands accessible from the App.
*/
    private function registerAppCommands()
    {
        $this->commands(Commands\MakeModelCommand::class);
    }
}
