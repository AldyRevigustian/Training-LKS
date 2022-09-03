<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Squad;
use App\Models\User;
use HttpHelper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return HttpHelper::responseJson(200, 'success get data', [
            "banners" => Banner::where('status', true)->get(),
            "squads" => Squad::with('members')->get(),
            "users" => User::where('role', 'member')->get()
        ]);
    }
}
