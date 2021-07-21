<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createToken(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 400,'message' => 'Bad Request']);
        } else {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['status_code' => 500 , 'message' => 'Unauthorized']);
            } else {
                $user = User::where('email',$request->email)->first();
                $token = $user->createToken('authToken')->plainTextToken;
                return ['token' => $token];
            }

        }

    }

    public function createDelete(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Token deleted successfully'
        ]);
    }

    public function memberPost(){
        return 'hi';
    }
}
