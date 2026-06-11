<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
       
        if(count($roles) > 0){
            return response() -> json([
                'status'=> true,
                'data'=> $roles
            ],200);
        }else{
            return response() -> json([
                'status'=> false,
                'data'=> 'Roles not available'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validateRole = Validator::make(
        $request -> all(),    
        [
            'name'=>'required | unique:roles,name'
        ]);
        if($validateRole -> fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validateRole->errors()->all()
            ]);
        }
        $role = Role::create([
            'name'=> $request -> name
        ]);
        if($role){
            return response()->json([
                'status'=>true,
                'message'=>'Role created successfully',
                'data'=>$role
            ],201);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Role is not created due to some error'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if($role){
            return response()->json([
                'status'=>true,
                'data'=>$role
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Role not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        if($role){
            $role->name = $request->name;
            $role->save();
            return response()->json([
                'status'=>true,
                'message'=>'Role updated successfully'
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Role not found'
            ],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if($role){
            $role->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Role removed successfully'
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Role not found'
            ],404);
        }
    }
}
