<?php

namespace Chicorycom\Cigaformation;

use Chicorycom\Cigaformation\Models\Event;
use Chicorycom\Cigaformation\Models\Formation;
use Chicorycom\Cigaformation\Models\Menu;
use Chicorycom\Cigaformation\Models\Page;
use Chicorycom\Cigaformation\Models\Permission;
use Chicorycom\Cigaformation\Models\Role;
use Chicorycom\Cigaformation\Models\User;
use Exception;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Cigaformation
{
    // Build wonderful things
    protected $models = [
        'Menu'        => Menu::class,
        'Page'        => Page::class,
        'Permission'  => Permission::class,
        'Role'        => Role::class,
        'User'        => User::class,
        'Event'       => Event::class,
        'Formation'   => Formation::class,
    ];


    public  function model($name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function useModel($name, $object)
    {
        if (is_string($object)) {
            $object = app($object);
        }

        $class = get_class($object);

        if (isset($this->models[Str::studly($name)]) && !$object instanceof $this->models[Str::studly($name)]) {
            throw new \Exception("[{$class}] must be instance of [{$this->models[Str::studly($name)]}].");
        }

        $this->models[Str::studly($name)] = $class;

        return $this;
    }

    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString|string
     *
     * @throws \Exception
     */
    public function mix($path, $manifestDirectory = '')
    {
        static $manifests = [];



        if (! Str::startsWith($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && ! Str::startsWith($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (is_file(public_path($manifestDirectory.'/hot'))) {
            $url = rtrim(file_get_contents(public_path($manifestDirectory.'/hot')));

            if (Str::startsWith($url, ['http://', 'https://'])) {
                return new HtmlString(Str::after($url, ':').$path);
            }

            return new HtmlString("//localhost:8080{$path}");
        }

        $manifestPath = public_path($manifestDirectory.'/mix-manifest.json');

        if (! isset($manifests[$manifestPath])) {
            if (! is_file($manifestPath)) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];
        $path = str_replace(config('cigaformation.assets').'/', '',  $path);
        if (! isset($manifest[$path])) {
            $exception = new Exception("Unable to locate Mix file: {$path}.");

            if (! app('config')->get('app.debug')) {
                report($exception);

                return $path;
            } else {
                throw $exception;
            }
        }


        return new HtmlString(app('config')->get('app.mix_url').$manifestDirectory.$manifest[$path]);
    }
}



