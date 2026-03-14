<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->validate([
            'login_pers' => 'required',
            'pwd_pers' => 'required|string|min:6',
        ]);

        $personnel = Personnel::where('login_pers', $credentials['login_pers'])->first();
        if(!$personnel || !Hash::check($credentials['login_pers'], $personnel->pwd_pers)){
            return response()->json(['message' => 'Invalid login or password'], 401);
        }

        $old_token = DB::table('personal_acces_tokens')->where("tokenable_id", $personnel->plainTextToken);
        if($old_token)
            DB::table('personal_access_tokens')->delete($old_token->get("id"));

        $expiration = Carbon::now()->addDays(1);
        $token = $personnel->createToken('user_token', ["*"], $expiration->plainTextToken);
        return response()->json([
            "personnel" => $personnel,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);

    }

    public function logout(Request $request)
    {
        $request->personnel()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
