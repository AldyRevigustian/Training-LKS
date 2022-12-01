<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Society;
use App\Models\Validation;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->token;

        if ($token) {
            $cek = Society::where('login_tokens', $token)->first();
            if ($cek) {

                $data = array(
                    'id' => $cek->validation->id,
                    'status' => $cek->validation->status,
                    'work_experience' => $cek->validation->work_experience,
                    'job_category_id' => $cek->validation->job_category_id,
                    'job_position' => $cek->validation->job_position,
                    'reason_accepted' => $cek->validation->reason_accepted,
                    'validator_notes' => $cek->validation->validator_notes,
                    'validator' => $cek->validation->validator,
                );
                return response()->json([
                    'validation' => $data
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

    public function store(Request $request)
    {
        $token = $request->token;

        if ($token) {
            $cek = Society::where('login_tokens', $token)->first();

            $work_experience = $request->work_experience;
            $job_category_id = $request->job_category_id;
            $job_position = $request->job_position;
            $reason_accepted = $request->reason_accepted;

            if ($cek) {
                $exist = Validation::where('society_id', $cek->id)->where('status', 'pending')->first();
                if (!$exist) {
                    $cr = Validation::create([
                        'society_id' => $cek->id,
                        'work_experience' => $work_experience,
                        'job_category_id' => $job_category_id,
                        'job_position' => $job_position,
                        'reason_accepted' => $reason_accepted,
                    ]);
                    if ($cr) {
                        return response()->json([
                            "message" => "Request data validation sent successful"
                        ], 200);
                    } else {
                        return response()->json([
                            "message" => "Request data validation sent failed"
                        ], 401);
                    }
                }else{
                    return response()->json([
                        'message' => "Can't Add More Validation"
                    ], 401);
                }
            } else {
                return response()->json([
                    'message' => 'Unauthorized user'
                ], 401);
            }
        }
    }
}
