<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validRequest = Validator::make(
            $request -> all(),
            [
                'email'=>'required|email',
                'password'=>'required'
            ]
        );
        if($validRequest -> fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Unauthenticated',
                'error'=>$validRequest->errors()->all()
            ],401);
        }else{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                $user = Auth::user();
                if (!$user->roles()->exists()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'No role assigned. Contact admin.'
                    ], 403);
                }
                return response()->json([
                    'status'=>true,
                    'message'=>'user loggen in successfully',
                    'token'=>$user->createToken('token')->plainTextToken,
                    'token_type'=>'bearer'
                ],200);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'email or password is incorrect',
                ],401);
            }
        }
    }
    public function logout(Request $request){
        $user = $request->user();
        if($user->tokens()->delete()){
            return response()->json([
                'status'=>true,
                'message'=>'Logout successfully'
            ]);
        }
    }
}
