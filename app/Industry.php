<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    ########## Relations
    public function jobs(){
        return $this->hasMany(\App\Job::class,'industry_id');
    }
    
	############ Protected
	protected $fillable = ['name_ar','name_en',];
	protected $dates = ['created_at', 'updated_at',];
}
