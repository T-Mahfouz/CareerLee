<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    ########## Relations
	public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }



	############ Protected
	protected $fillable = ['user_id','course','duration',];
	protected $dates = ['created_at', 'updated_at',];
}
