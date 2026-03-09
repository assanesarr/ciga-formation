<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 15/10/20
 * Time: 15:45
 */

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;


use Chicorycom\Cigaformation\Http\Controllers\Controller;
use Chicorycom\Cigaformation\Models\Countdown;
use Chicorycom\Cigaformation\Models\Role;
use Chicorycom\Cigaformation\Models\Slide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{

    /**
     * @return JsonResponse
     */
        public function roles(){
            return new JsonResponse(Role::all(), 200, [], JSON_NUMERIC_CHECK);
        }

    /**
     * @return JsonResponse
     */
        public function carousel() {
            return new JsonResponse(Slide::carouselall() , 200, [], JSON_NUMERIC_CHECK);
        }

    /**
     * @param Request $request
     * @return JsonResponse
     */
        public function storeCarousel(Request $request){

            $request->validate([
                'title' => 'required|string|max:255',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            if($request->hasFile('img')){
                $thumbnail = $this->resize($request->file('img'), 256, 144, true);
                $img_banner = $this->resize($request->file('img'), 1024, 483, true);
            }

                $slide =  Slide::create([
                  'title'=> $request->title,
                  'src' => $img_banner,
                  'thumbnail' => $thumbnail,
                ]);

            return new JsonResponse($slide, 201, [], JSON_NUMERIC_CHECK);

        }

    /**
     * @param $id
     * @return JsonResponse
     */
        public function statusCarousel($id){
                $slide = Slide::find($id);
                $status = !$slide->status;
                $slide->update(['status' => $status]);
            return new JsonResponse($slide, 201, [], JSON_NUMERIC_CHECK);
        }

    /**
     * @param Slide $slide
     * @return JsonResponse
     */
        public function editCarousel(Slide $slide){
            return new JsonResponse($slide, 200, [], JSON_NUMERIC_CHECK);
        }

    /**
     * @param Request $request
     * @param Slide $slide
     * @return JsonResponse
     */
        public function updateCarousel(Request $request, Slide $slide){
            $request->validate([
                'title' => 'required|string|max:255',
            ]);
            $slide->update([
                'title'=> $request->title,
            ]);
            return new JsonResponse($slide, 201, [], JSON_NUMERIC_CHECK);
        }

    /**
     * @param Slide $slide
     * @return JsonResponse
     * @throws \Exception
     */
        public function deleteCarousel(Slide $slide){
            File::delete(public_path($slide->src));
            File::delete(public_path($slide->thumbnail));
            $slide->delete();
            //JSON_PRETTY_PRINT
            return new JsonResponse(['success' => true], 204);
        }


        public function countdown(Countdown $countdown){
            return $countdown;
        }

        public function countdownStore(Request $request){
            $request->validate([
                'start' => 'required|date',
                'end' => 'required|date',
            ]);
            $startDate = strtotime($request->start);
            $endDate = strtotime($request->end);
            if(($endDate - $startDate) > (60 * 60)){
                $count = Countdown::count();
                $count->update(['start'=> $request->start, 'end' => $request->end]);
                return new JsonResponse($count, 201);
            }
           return new JsonResponse(['errors' => ['end' => 'fin d\'inscription doit supérieur au debut' ]], 422);
        }

        public function countdownStatus(){
            $count = Countdown::count();
            $status = !$count->status;
            $count->update(['status'=>$status]);
            return new JsonResponse($count, 201);
        }
}
