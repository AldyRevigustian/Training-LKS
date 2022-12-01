<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $id_card = $request->id_card_number;
        $password = $request->password;

        $soc = Society::where('id_card_number', $id_card)->where('password', $password)->first();

        if ($soc) {
            $soc->update([
                'login_tokens' => md5($id_card)
            ]);
            $data = array(
                'name' => $soc->name,
                'born_date' => $soc->born_date,
                'gender' => $soc->gender,
                'address' => $soc->address,
                'token' => $soc->login_tokens,
                'regional' => $soc->regional
            );
            return response()->json([
                $data
            ], 200);
        } else {
            return response()->json([
                'message' => "ID Card Number or Password incorrect"
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->token;

        if ($token != null) {
            $cek = Society::where('login_tokens', $token)->first();
            if ($cek) {
                $cek->update([
                    'login_tokens' => null
                ]);
                return response()->json([
                    'message' => "Logout success"
                ], 200);
            }else{
                return response()->json([
                    'message' => "Invalid token"
                ], 401);
            }
        }else{
            return response()->json([
                'message' => "Invalid token"
            ], 401);
        }
    }
}
