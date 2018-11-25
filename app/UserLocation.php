<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    ########## Relations
	public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }


	############ Protected
	protected $fillable = ['user_id','location',];
	protected $dates = ['created_at', 'updated_at',];
}
