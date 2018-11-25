<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
	########## Relations
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }


	############ Protected
    protected $fillable = [
    	'user_id','institution','degree','start_at','end_at',
    ];
    protected $dates = [
    	'created_at','updated_at','start_at','end_at',
    ];
}
