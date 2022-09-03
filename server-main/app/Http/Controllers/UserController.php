<?php

namespace App\Http\Controllers;

use App\Models\User;
use HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return HttpHelper::responseJson(200, "Success get users", $users);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dob' => 'required',
            'picture' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $image = $request->file('picture');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['picture'] = $filename;
        $image->move(public_path("users"), $filename);

        $squad = User::create($data);
        return HttpHelper::responseJson(201, "Success create squad", $squad);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $data = $request->all();
        $image = $request->file('picture');
        if($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("users"), $filename);
            $data['picture'] = $filename;
        }
        if(count($data['password']) > 0) {
            $data['password'] = Hash::make($data['password']);
        }

        $squad = $user->update($data);
        return HttpHelper::responseJson(200, "Success update squad", $squad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
