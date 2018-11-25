<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    ########## Relations
    public function user(){
        return $this->belongsTo(\App\User::class,'user_id');
    }

	############ Protected
    protected $fillable = ['user_id','skill',];
    protected $dates = ['created_at', 'updated_at',];
}
