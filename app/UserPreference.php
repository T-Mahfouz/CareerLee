<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    ########## Relations
	public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }
    public function industry(){
        return $this->belongsTo(\App\Industry::class,'industry_id');
    }


	############ Protected
	protected $fillable = ['user_id','industry_id',];
	protected $dates = ['created_at', 'updated_at',];
}
