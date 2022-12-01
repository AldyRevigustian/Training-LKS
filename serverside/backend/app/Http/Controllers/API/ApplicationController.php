<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobApplyPosition;
use App\Models\JobApplySocieties;
use App\Models\JobVacancy;
use App\Models\Society;
use App\Models\Vacancy;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ApplicationController extends Controller
{

    public function index(Request $request)
    {
        $token = $request->token;

        if ($token != null) {
            $cek = Society::where('login_tokens', $token)->first();
            if ($cek) {
                $vc = JobVacancy::where('id', $cek->jobSocieties->job_vacancy_id)->get();
                $data = [];

                foreach ($vc as $v) {
                    $data[] = [
                        'id' => $v->id,
                        'category' => $v->category,
                        'company' => $v->company,
                        'address' => $v->address,
                        'description' => $v->description,
                        // 'position' => 
                    ];
                }
                return response()->json([
                    'vacancies' => $data
                ]);
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
        $vacancy_id = $request->vacancy_id;
        $notes = $request->notes;

        $positions = json_decode($request->positions);

        if ($token != null) {
            $cek = Society::where('login_tokens', $token)->first();

            if ($cek) {
                $double = JobApplySocieties::where('society_id', $cek->id)->get();

                if (!$double->isEmpty()) return response()->json([
                    "message" => " Application for a job can only be once"
                ]);

                $validate = Validation::where('society_id', $cek->id)->whereIn('job_position', $positions)->get();

                if ($validate->isEmpty()) {
                    return response()->json([
                        "message" => "Your data validator must be accepted by validator before"
                    ], 401);
                }

                foreach ($validate as $v) {
                    if ($v->status == 'pending' || $v->status == 'declined' || $v == null) {
                        return response()->json([
                            "message" => "Your"
                        ], 401);
                    }
                }

                $app = JobApplySocieties::create([
                    'date' => date('y-m-d'),
                    'notes' => $notes,
                    'society_id' => $cek->id,
                    'job_vacancy_id' => $vacancy_id,
                ]);

                if ($app) {
                    foreach ($positions as $p) {
                        JobApplyPosition::create([
                            'date' => date('y-m-d'),
                            'society_id' => $cek->id,
                            'job_apply_societies_id' => $app->id,
                            'job_vacancy_id' => $vacancy_id,
                            'position_id' => $p
                        ]);
                    }
                }
                return response()->json([
                    'message' => 'Applying for job successful'
                ]);
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
