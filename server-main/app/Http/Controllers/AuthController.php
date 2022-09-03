<?php

namespace App\Http\Controllers;

use App\Models\User;
use HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required', 
            'password' => 'required'
        ]);

        if($validator->fails()) 
            return HttpHelper::validationError($validator->errors(), "Invalid credentials");
        if (!Auth::attempt($request->only('username', 'password'))) 
            return HttpHelper::responseJson(401, 'Invalid credentials');

        $user = User::with(['score'=>function($q) {
            $q->orderBy('score', 'desc');
        }])->where('username', $request->username)->first();
        if(!$user) return HttpHelper::responseJson(401, 'Invalid credentials');

        $accessToken = $user->createToken('access_token')->plainTextToken;

        return HttpHelper::responseJson(200, 'Successfully logged in', [
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dob' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return HttpHelper::validationError($validator->errors(), "Validation error");

        $picture = $request->file('picture');
        $filename = time() . '.' . $picture->getClientOriginalExtension();

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['picture'] = $filename;
        $data['role'] = 'member';
        $user = User::create($data);

        $picture->move(public_path("profile"), $filename);

        return HttpHelper::responseJson(200, "Register success", $user);
    }
}
