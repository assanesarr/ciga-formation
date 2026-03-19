<?php

namespace Chicorycom\Cigaformation\Http\Controllers;

use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Chicorycom\Cigaformation\Http\Controllers\ContentTypes\Image as ContentImage;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $slug;
    /**
     * @param String $view
     */
    private function exist(String $view){
        return view()->exists("chicorycom::pages.{$view}") ?: abort(404);
    }

    /**
     * @param String $view
     * @param mixed ...$args
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view(String $view, ...$args){
        if($view == "/"){
            $view = 'home';
        }
        $this->exist("$view");
        $args[0]['menus'] = Menu::public();
        return view("chicorycom::pages.{$view}", $args[0]);
    }

    /**
     * @param $file
     * @param int $width
     * @param int $height
     * @param bool $crop
     * @return string
     */
    protected function resize($file, int $width = 70, int $height=null, $crop = false) :string {
        $image = Image::make($file)
            ->orientate()
            ->interlace();

        if($crop) $image->crop($width, $height);

            $image = $image->resize(
                $width,
                $height,
                function (Constraint $constraint) use($crop) {
                   // $constraint->aspectRatio();
                   // $constraint->upsize();
                }
            )->encode($file->getClientOriginalExtension(), 75);

        $this->slug = $this->getSlug(Request());
        $path = $this->getSlug(request()).DIRECTORY_SEPARATOR.date('FY').DIRECTORY_SEPARATOR;
        $filename = md5(Str::random(7));
        // Make sure the filename does not exist, if it does, just regenerate
        while (Storage::exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
            $filename = md5(Str::random(7));
        }
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($fullPath, (string) $image, 'public');
        return Storage::url($fullPath);
    }

    public function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $slug = explode('/', $request->path())[1];
        }

        return $slug;
    }
}
