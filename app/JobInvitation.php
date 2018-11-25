<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobInvitation extends Model
{
    ########## Relations
	public function employer(){
        return $this->belongsTo(\App\User::class,'employer_id');
    }
    public function employee(){
        return $this->belongsTo(\App\User::class,'employee_id');
    }


	############ Protected
	protected $fillable = ['employer_id','employee_id','status',];
	protected $dates = ['created_at', 'updated_at',];
}
