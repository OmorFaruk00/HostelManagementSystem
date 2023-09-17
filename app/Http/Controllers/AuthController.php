<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use illuminate\Auth\AuthenticationException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'c_password'=>'required|same:password'
        ]);

        if($validator->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator->errors()
            ];
            return response()->json($response,422);
        }

        $input = $request->all();
        $input['password']=bcrypt($input['password']);
        User::create($input);
        return response()->json(['message'=>'User register successfully','status'=>200]);

    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator->errors()
            ];
            return response()->json($response);
        }
     
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 203);
            }
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    "message" => 'The given password is invalid.'
                ], 203);
            }
         
            $token = $user->createToken($request->email)->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,

            ];
            return response($response, 201);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
    
}
