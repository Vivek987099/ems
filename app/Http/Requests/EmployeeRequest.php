<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'phone'=>'required',
            'city'=>'required',
            'gender'=>'required',
            'profile_image'=>"nullable|image",
            'user_id'=>'required | exists:users,id| unique:employees,user_id',
            'department_id'=>'required | exists:departments,id'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'=>'Please select user',
            'department_id.required'=>'Please select department'
        ];
    }

}
