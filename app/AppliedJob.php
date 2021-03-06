<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    ########## Relations
	public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
    public function job(){
        return $this->belongsTo(\App\Job::class,'job_id');
    }

	############ Protected
	protected $fillable = ['user_id','job_id',];
	protected $dates = ['created_at', 'updated_at',];
}
