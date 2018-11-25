<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    ########## Relations
	public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }

	############ Protected
	protected $fillable = [
		'user_id','position','company_name','from','to','current','company_image',
	];
	protected $dates = ['created_at', 'updated_at','from','to',];
}
