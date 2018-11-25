<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    ########## Relations
	public function job(){
        return $this->belongsTo(\App\Job::class,'job_id');
    }


	############ Protected
	protected $fillable = ['job_id','tag',];
	protected $dates = ['created_at', 'updated_at',];
}
