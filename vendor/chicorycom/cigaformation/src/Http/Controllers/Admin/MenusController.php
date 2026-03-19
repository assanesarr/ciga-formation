<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 12/10/20
 * Time: 12:05
 */

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;


use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenusController
{
    public function index(){

        return new JsonResponse(Menu::admin(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function publicMenus(){
        return new JsonResponse(Menu::public(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'in:PUBLIC,ADMIN',
            //'slug' => 'required|unique:menus,slug',
            //'icon' => 'required|string|max:11',
            //'target' => 'required|string|max:11',
        ]);
        if($request->id){
            Menu::find($request->id)->update($request->except(['id']));
        }else{
            Menu::create($request->all());
        }

        $menus = $request->type == 'ADMIN' ?  Menu::admin() : Menu::public();
        return new JsonResponse($menus, 201, [], JSON_NUMERIC_CHECK);

    }

    public function destroy(Menu $menu){

        $menu->delete();
        $menus = $menu->type == 'ADMIN' ?  Menu::admin() : Menu::public();
        return new JsonResponse($menus, 200, [], JSON_NUMERIC_CHECK);
    }
}
