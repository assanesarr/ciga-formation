<?php

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;

use Chicorycom\Cigaformation\Http\Controllers\Controller;
use Chicorycom\Cigaformation\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function user(Request $request){
        return new JsonResponse(Auth::user(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function users(){
        return new JsonResponse(User::admin(), 200, [], JSON_NUMERIC_CHECK);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:11',
        ]);
        //dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company' => $request->company,
            'salary' => $request->salary
        ]);

        return new JsonResponse($user, 201, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string|max:21',
        ]);
        $collection = collect([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'company' => $request->company,
            'salary' => $request->salary
        ]);

        if($request->password != null){
            $collection = $collection->merge([
                'password' => Hash::make($request->password)
            ]);
        }

        $user->update($collection->all());

        return new JsonResponse($user, 201, [], JSON_NUMERIC_CHECK);
    }


    /**
     * @param User $user
     * @return JsonResponse
     */
    public function edit(User $user){
        return new JsonResponse($user, 200, [], JSON_NUMERIC_CHECK);
    }


    /**
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user){
        $user->delete();
        return new JsonResponse($user, 204, [], JSON_NUMERIC_CHECK);
    }



}
