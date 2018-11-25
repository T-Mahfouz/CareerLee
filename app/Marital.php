<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    ########## Relations


	############ Protected
	protected $fillable = ['name_ar','name_en',];
	protected $dates = ['created_at', 'updated_at',];
}
