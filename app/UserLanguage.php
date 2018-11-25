<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    ########## Relations

	############ Protected
	protected $fillable = ['user_id','language',];
	protected $dates = ['created_at', 'updated_at',];
}
