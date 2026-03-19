<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 29/09/20
 * Time: 14:41
 */

namespace Chicorycom\Cigaformation\Commands;




use Chicorycom\Cigaformation\CigaformationServiceProvider;
use CyrildeWit\EloquentViewable\EloquentViewableServiceProvider;
use Database\Seeders\ChicorycomDatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

//use Chicorycom\Cigaformation\Traits\Seedable;


class InstallCommand extends Command
{




    //protected $seedersPath = __DIR__.'/../../database/seeders/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'chicorycom:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Chicorycom Admin package';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Publishing the Chicorycom assets, database, and config files');

        // Publish only relevant resources on install
        $tags = ['assets'];

        //$filesystem->cleanDirectory('database/seeders');
        $this->call('vendor:publish', ['--provider' => CigaformationServiceProvider::class]);
        $this->call('vendor:publish', ['--provider' => LaravelServiceProvider::class]);
        //$this->call('vendor:publish', ['--provider' => EloquentViewableServiceProvider::class, '--tag'=>'migrations']);

       // $this->call('jwt:secret', ['--force' => $this->option('force')]);

        $this->info('Attempting to set Chicorycom Auth driver');
        if (file_exists(config_path('auth.php'))) {
            $userPath =  config_path('auth.php');

            $str = file_get_contents(__DIR__.'/../../config/auth.php');

            if ($str !== false) {
                //$str = str_replace("'guard' => 'web'", "'guard' => 'api'", $str);
                file_put_contents($userPath, $str);

                //$str = str_replace("'driver' => 'token'", "'driver' => 'jwt'", $str);
                //file_put_contents($userPath, $str);
            }
        } else {
            $this->warn('Unable to locate "auth.php" in app .  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "driver => token" to "driver => jwt " in your auth config');
        }


        $this->info('Migrating the database tables into your application');
        $filesystem->cleanDirectory('database/migrations');
       // $this->call('migrate', ['--force' => $this->option('force')]);


        $this->info('Attempting to set Chicorycom User model as parent to App\User');
        if (file_exists(app_path('User.php')) || file_exists(app_path('Models/User.php'))) {
            $userPath = file_exists(app_path('User.php')) ? app_path('User.php') : app_path('Models/User.php');

            $str = file_get_contents($userPath);

            if ($str !== false) {
                $str = str_replace('extends Authenticatable', "extends \Chicorycom\Cigaformation\Models\User", $str);

                file_put_contents($userPath, $str);
            }
        } else {
            $this->warn('Unable to locate "User.php" in app or app/Models.  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \Chicorycom\Cigaformation\Models\User" in your User model');
        }


        $this->info('Attempting to set Chicorycom jwt config file');
        if (file_exists(config_path('jwt.php'))) {
            $jwtPath =  config_path('jwt.php');

            $str = file_get_contents($jwtPath);

            if ($str !== false) {
                $str = str_replace("Lcobucci::class", "Namshi::class", $str);

                file_put_contents($jwtPath, $str);
            }
        } else {
            $this->warn('Unable to locate "jwt.php" .  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "Lcobucci::class" to "Namshi::class" in your jwt file config');
        }

        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();

        $process = new Process([$composer.' dump-autoload']);
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Adding Chicorycom routes to routes/web.php');
        $routes_chicorycom = $filesystem->get(__DIR__.'/../../routes/web.php');

        if($routes_chicorycom !== false){
            $filesystem->put(base_path('routes/web.php'), $routes_chicorycom);
        }


        //$this->info('Seeding data into the database');

       // $this->call('db:seed', ['--class' => ChicorycomDatabaseSeeder::class]);

        $this->info('link public app');
        $this->call('chicorycom:publish', ['--public' => '--public']);


        //$this->info('Setting up the hooks');
        //$this->call('hook:setup');



        $this->info('Successfully installed Chicorycom! Enjoy');
    }
}
