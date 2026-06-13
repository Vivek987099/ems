<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['user','department']) -> paginate(5);
       
        if(count($employees) > 0){
            return response() -> json([
                'status'=> true,
                'data'=> $employees
            ],200);
        }else{
            return response() -> json([
                'status'=> false,
                'data'=> 'Employees not available'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {   
        $validatedEmp = $request->validated();
        if($request -> hasFile('profile_image')){
            $path = $request -> file('profile_image') -> store('image','public');
            $validatedEmp['profile_image'] = $path;
        }
        $emp = Employee::create($validatedEmp);
        if($emp){
            return response()->json([
                'status'=>true,
                'message'=>'Employee created successfully',
                'data'=>$emp
            ],201);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Employee is not created due to some error',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emp = Employee::with(['user','department'])->find($id);
        if($emp){
            return response()->json([
                'status'=>true,
                'data'=>$emp
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Employee is not available'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $emp = Employee::find($id);
        $oldProfileImg = $emp -> profile_image;
        $oldUserId = $emp->user_id;
        $emp->name = $request->name;
        $emp->city=$request->city;
        $emp->department_id=$request->department_id;
        $emp->gender=$request->gender;
        $emp->phone=$request->phone;
        $emp->address=$request->address;
        if($request->user_id){
            $emp->user_id=$request->user_id;
        }else{
            $emp->user_id=$oldUserId;
        }
        if($request->hasFile('profile_image')){
            if($emp->profile_image){
                $path = public_path('/storage/').$emp->profile_image;
                unlink($path);
            }
            $emp->profile_image = $request->file('profile_image')->store('image','public');
        }else{
            $emp->profile_image=$oldProfileImg;
        }
        if($emp->save()){
            return response()->json([
                'status'=>true,
                'message'=>'Employee updated successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp = Employee::find($id);
        if($emp){

            if($emp->profile_image){
                $file = public_path('/storage/').$emp->profile_image;
                if(file_exists($file)){
                    unlink($file);
                }
            }

            $emp -> delete();
            return response()->json([
                'status'=>true,
                'message'=>'Employee removed successfully'
            ],200);
            
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Employee not found'
            ],404);
        }
    }
}
