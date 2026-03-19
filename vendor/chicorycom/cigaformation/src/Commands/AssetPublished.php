<?php

namespace Chicorycom\Cigaformation\Commands;

use Chicorycom\Cigaformation\ChicorycomPublishedProvider;
use CyrildeWit\EloquentViewable\EloquentViewableServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class AssetPublished extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chicorycom:publish {--public}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $public = $this->option('public');
        if($public){
            $publishablePath = __DIR__.'/../../public/*';
            $asset = public_path('/');
            $message = "Chicorycom public folder is link to {$asset}";
            $te = exec("ln -s $publishablePath $asset");
            $this->error($te);
            if (!file_exists(public_path($asset))) {
                //symlink($publishablePath, public_path($asset));
                $message = "Attempting to set Chicorycom public folder to {$asset}" ;
            }
            $this->info($message);
            $this->call('vendor:publish', ['--provider' => EloquentViewableServiceProvider::class, '--tag'=>'migrations']);
            return 0;
        }
        $this->error('Not option ');

    }
}
