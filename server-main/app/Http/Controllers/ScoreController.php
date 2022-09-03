<?php

namespace App\Http\Controllers;

use App\Models\Score;
use HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $leaderboard = Score::with(['user', 'user.score' => function($q) {
            $q->max('score');
        }])->orderBy('score', 'desc')->distinct('user_id')->take(10)->get();
        return HttpHelper::responseJson(200, "Success get leaderboard", $leaderboard);
    }

    /**
     * Save a score to database
     *
     * @return \Illuminate\Http\Response
     */
    public function saveScore(Request $request)
    {
        
        $user_id = Auth::user()->id;
        $score = Score::create([
            'user_id' => $user_id,
            'score' => $request->score,
            'lifetime' => $request->lifetime
        ]);

        return HttpHelper::responseJson(200, "Success save score", $score);
    }

}
