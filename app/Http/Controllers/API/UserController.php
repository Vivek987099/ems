<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerUser(UserRequest $req){
        $user = User::create([
            'email'=> $req -> email,
            'password'=> $req -> password
        ]);
        $user -> roles()->attach($req->role_id);
        if($user){
            return response() -> json([
                'status'=> true,
                'message'=>'User registered successfully',
                'data'=>$user
            ],200);
        }else{
            return response() -> json([
                'status'=>false,
                'message'=>'something went wrong'
            ],401);
        }
    }

    public function allUsers(){
        $users = User::with('roles')->get();
        if(count($users) > 0){
            return response()->json([
                'status'=>true,
                'data'=>$users
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Users not available'
            ]);
        }
    }

    public function userWithNoEmp(){
       $users = User::doesnthave('employee')->get();
       if($users){
            return response()->json([
                'status'=>true,
                'data'=>$users
            ]);
       }
    }

    public function show($id){
        $user = User::find($id);
        if($user){
            return response()->json([
                'status'=>true,
                'data'=>$user
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'User not found'
            ],404);
        }
    }

    public function destroy($id){
        $user = User::find($id);
        if($user){
            if($user->delete()){
                return response()->json([
                    'status'=>true,
                    'message'=>'User Deleted Successfully'
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'user not found'
            ]);
        }
    }
}
