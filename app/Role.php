<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    ########## Relations


	############ Protected
	protected $fillable = ['name',];
	protected $dates = ['created_at', 'updated_at',];
}
