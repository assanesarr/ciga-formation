<?php

namespace Chicorycom\Cigaformation\Http\Controllers;

use Chicorycom\Cigaformation\Cigaformation;
use Chicorycom\Cigaformation\Models\Countdown;
use Chicorycom\Cigaformation\Models\Event;
use Chicorycom\Cigaformation\Models\Formation;
use Chicorycom\Cigaformation\Models\Menu;
use Chicorycom\Cigaformation\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends ChicorycomBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @param $view
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($view='/')
    {
            $data = null;
            $events = [];
            if($view == "/" or $view == 'accueil'){
                $view = 'home';
            }
            if($view == 'home'){
                $events = Event::events();
            }
            if($view == 'a-propos'){
                $events = Event::where('type', 'DIRECTOR')->first();
            }

            $default = view()->exists("chicorycom::pages.{$view}") ? $view : 'default';
            $v = Menu::where('slug', $view)->first();

            $view = $v ? $v : $view;
            $countdown = Countdown::count();


            $route = route('page', isset($view->name) ? $view->slug : $view ) ;
            return $this->view($default, compact('view', 'route', 'events', 'countdown'));
    }


    public function detail($view, $slug){

        $default = view()->exists("chicorycom::pages.{$view}") ? $view : 'default';
        $class = '\Chicorycom\Cigaformation\Models\\'.str::studly($default);
        $data = new \stdClass();
        $events = Event::events();

        if(class_exists($class)){
            $model = app($class);
            $data = $model->where('slug', $slug)->firstOrfail();
            views($data)->record();
        }
       // $data = Formation::where('slug', $slug)->firstOrfail();
        $route = route('page',  $view . '/'. $slug) ;

        return $this->view($default, compact('view', 'route', 'data', 'events'));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function preRegister(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'email' => 'required|string|email|unique:users|max:255',
        ]);
        $response = $request->all();
        $response['redirect'] = url('/espace-etudiants?p=pre-register');
        //dd($response['redirect']);
        return new JsonResponse($response, 200);
    }

    public function students(){

        return view("chicorycom::pages.students.home");
    }

    public function content($view){
        $default = view()->exists("chicorycom::pages.students.sections.{$view}") ? "chicorycom::pages.students.sections.$view" : 'chicorycom::pages.students.sections.default';
        return view($default, compact('view'));

    }
}
