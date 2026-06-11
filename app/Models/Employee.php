<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    

    protected $fillable =[
        'name','phone','city','gender','user_id','department_id','status','profile_image'
    ];
    protected $hidden =[
        'status'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: function($value){
                return ucwords(strtolower($value));
            }
        );
    }

    public function department(){
        return $this -> belongsTo(Department::class);
    }
    public function user(){
        return $this -> belongsTo(User::class);
    }
}
