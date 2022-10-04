<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use App\Models\Society;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->token;
        if ($token) {
            $cek = Society::where('login_tokens', $token)->first();
            if ($cek) {
                $vc = JobVacancy::get();
                $data = [];

                foreach ($vc as $v) {
                    $data[] = [
                        'id' => $v->id,
                        'category' => $v->category,
                        'company' => $v->company,
                        'address' => $v->address,
                        'description' => $v->description,
                        'available_position' => $v->positions
                    ];
                }
                return response()->json([
                    "vacancies" => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = $request->token;
        if ($token) {
            $cek = Society::where('login_tokens', $token)->first();
            if ($cek) {
                $vc = JobVacancy::where('id', $id)->get();
                $data = [];
                foreach ($vc as $v) {
                    $data = array(
                        'id' => $v->id,
                        'category' => $v->category,
                        'company' => $v->company,
                        'address' => $v->address,
                        'description' => $v->description,
                        'available_position' => $v->positions
                    );
                }
                return response()->json([
                    "vacancy" => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }
    }
}
