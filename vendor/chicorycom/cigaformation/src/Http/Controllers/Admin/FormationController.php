<?php

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;

use Chicorycom\Cigaformation\Http\Controllers\Controller;
use Chicorycom\Cigaformation\Models\Formation;
use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(Formation::all(), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function type()
    {
        return new JsonResponse(Menu::formations(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|exists:menus,id',
            //'slug' => 'required|unique:menus,slug',
            //'level' => 'required|string',
            'body' => 'required|string',
            //'duration' => 'required|string|max:11',
            //'seats' => 'required|string|max:11',
            //'schedule' => 'required|string|max:11',
            'img_read' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'img_view' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'price' => 'required|string|max:11',
        ]);
        $collection = collect($request->except(['id', 'img_read', 'thumbnail', 'img_view']));
        if(!$request->level) {
            $collection = $collection->except(['level']);
        }
        if(!$request->duration){
            $collection = $collection->except(['duration']);
        }
        $collection = $collection->merge([
            'status' => $request->status == 'true' ? true : false,
            'top'=> $request->top == 'true' ? true : false,
        ]);

       // (new Image($request, , $row, $options))->handle();

        $img_read = $this->resize($request->file('img_read'), 276, 352);
        $thumbnail = $this->resize($request->file('thumbnail'), 251, 157);
        $img_view = $this->resize($request->file('img_view'), 730, 340);

        $collection = $collection->merge([
            'thumbnail' => $thumbnail,
            'img_read'=> $img_read,
            'img_view' => $img_view,
        ]);
        $formation = Formation::create($collection->all());

        return new JsonResponse($formation , 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Formation $formation
     * @return Formation
     */
    public function edit(Formation $formation)
    {
        return $formation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Formation $formation
     * @return JsonResponse
     */
    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|exists:menus,id',
            'body' => 'required|string',
            'price' => 'required|string|max:11',
        ]);

        $collection = collect($request->except(['id', 'img_read', 'thumbnail', 'img_view']));
        if(!$request->level) {
            $collection = $collection->except(['level']);
        }
        if(!$request->duration){
            $collection = $collection->except(['duration']);
        }
        $collection = $collection->merge([
            'status' => $request->status == 'true' ? true : false,
            'top'=> $request->top == 'true' ? true : false,
        ]);



        if($request->hasFile('img_read')){
            $img_read = $this->resize($request->file('img_read'), 276, 352);
            $collection = $collection->merge([
                'img_read'=> $img_read,
            ]);
            File::delete(public_path($formation->img_read));

        }
        if($request->hasFile('thumbnail')){
            $thumbnail = $this->resize($request->file('thumbnail'), 251, 157);
            $collection = $collection->merge([
                'thumbnail' => $thumbnail,
            ]);
            File::delete(public_path($formation->thumbnail));
        }
        if($request->hasFile('img_view')){
            $img_view = $this->resize($request->file('img_view'), 730, 340);
            $collection = $collection->merge([
                'img_view' => $img_view,
            ]);
            File::delete(public_path($formation->img_view));
        }

        $formation->update($collection->all());

        return new JsonResponse($formation , 201);
    }

    /**
     * @param Formation $formation
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Formation $formation)
    {

            File::delete(public_path($formation->thumbnail));
            File::delete(public_path($formation->img_view));
            File::delete(public_path($formation->img_read));
            $formation->delete();

            return new JsonResponse($formation , 204);
    }
}
