<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    ########## Relations
	public function users(){
        return $this->hasMany(\App\User::class,'gender_id');
    }


	############ Protected
	protected $fillable = ['name_ar','name_en',];
	protected $dates = ['created_at', 'updated_at',];
}
