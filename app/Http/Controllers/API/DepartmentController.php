<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('employees')->get();
        if(count($departments) > 0){
            return response()->json([
                'status'=>true,
                'message'=>'All departments',
                'data'=>$departments
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Departments are not available'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateDepartment = Validator::make(
            $request -> all(),
            ['department_name'=>'required | unique:departments,department_name']
        );
        if($validateDepartment -> fails()){
            return response() -> json([
                'status'=> false,
                'error'=> $validateDepartment -> errors() -> all()
            ]);
        }
        $department = Department::create([
            'department_name'=> $request -> department_name
        ]);
        if($department){
            return response() -> json([
                'status'=>true,
                'message'=>'department created successfully',
                'data'=> $department
            ],201);
        }else{
            return response() -> json([
                'status'=> false,
                'data'=> 'department is not created due to some error'
            ],404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::with('employees')->find($id);
        if($department){
            return response()->json([
                'status'=>true,
                'data'=>$department
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Department is not available'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::find($id);
        if($department){
            $department -> department_name= $request -> department_name;
            $department->save();
            return response()->json([
                'status'=>true,
                'message'=>'Department updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Department not found'
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        if($department){
            $status = $department->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Department removed successfully'
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Department not available'
            ],404);
        }
    }
}
