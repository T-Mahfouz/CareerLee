<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    ########## Relations
	public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
    public function tags(){
        return $this->hasMany(\App\JobTag::class,'job_id');
    }

	############ Protected
	protected $fillable = [
		'user_id','title','address','requirements','description','start_salary','final_salary','salary_per','featured','image','company_name',
	];
	protected $dates = ['created_at', 'updated_at',];
}
