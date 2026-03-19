<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 11/11/20
 * Time: 10:07
 */

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;


use Chicorycom\Cigaformation\Http\Controllers\Controller;
use Chicorycom\Cigaformation\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
     public function index(){
         return new JsonResponse(Category::all(), 200, [], JSON_NUMERIC_CHECK);
     }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function edit(Category $category)
    {
        return new JsonResponse($category, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::create($request->except(['id']));

        return new JsonResponse($category, 200, [], JSON_NUMERIC_CHECK);
    }



    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->except(['id']));

        return new JsonResponse($category , 201);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return new JsonResponse($category , 204);
    }
}
