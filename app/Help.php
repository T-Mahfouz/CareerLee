<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    ########## Relations
	
	############ Protected
	protected $fillable = [
		'title_ar','content_ar','title_en','content_en',
	];
	protected $dates = ['created_at', 'updated_at',];
}
