<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 27/10/20
 * Time: 13:12
 */

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;


use Chicorycom\Cigaformation\Http\Controllers\Controller;
use Chicorycom\Cigaformation\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(Page::all(), 200);
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
            'menus' => 'required|exists:menus,id',
            'type' => 'in:GRID,LIST,DETAIL',
            'excerpt' => 'required|string',
        ]);
        $collection = collect($request->except(['id', 'background', 'menus']));

        if($request->hasFile('background')){
            $background = $this->resize($request->file('background'), 1920, 450, true);
            $thumbnail = $this->resize($request->file('background'), 480, 113, true);
            $collection = $collection->merge([
                'background' => $background,
                'thumbnail' => $thumbnail
            ]);
        }

        $page = Page::create($collection->all());
        if(!empty($request->menus)){
            $page->menus()->sync($request->menus);
        }
        return new JsonResponse($page , 201);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function edit(Page $page)
    {
        $page = $page->with('menus')->findOrFail($page->id);
        return new JsonResponse($page, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'menus' => 'required|exists:menus,id',
            'type' => 'in:GRID,LIST,DETAIL',
            'excerpt' => 'required|string',
        ]);

        $collection = collect($request->except(['id', 'background', 'menus']));

        if($request->hasFile('background')){
            $background = $this->resize($request->file('background'), 1920, 450, true);
            $thumbnail = $this->resize($request->file('background'), 480, 113, true);
            $collection = $collection->merge([
                'background' => $background,
                'thumbnail' => $thumbnail
            ]);
            File::delete(public_path($page->background));
            File::delete(public_path($page->thumbnail));
        }

        $page->update($collection->all());

        if(!empty($request->menus)){
            $page->menus()->sync($request->menus);
        }

        return new JsonResponse($page, 201);
    }

    /**
     * @param Page $page
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {

        if($page->background != '/images/banner.jpg'){
            File::delete(public_path($page->background));
            File::delete(public_path($page->thumbnail));
        }
        $page->delete();

        return new JsonResponse($page , 204);
    }

}
