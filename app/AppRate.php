<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppRate extends Model
{
    ########## Relations
	public function role(){
        return $this->belongsTo(\App\User::class,'user_id');
    }


	############ Protected
	protected $fillable = ['user_id','rate',];
		
	protected $dates = ['created_at', 'updated_at',];
}
