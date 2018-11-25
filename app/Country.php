<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    ########## Relations
	public function companies(){
        return $this->hasMany(\App\Company::class,'country_id');
    }


	############ Protected
	protected $fillable = ['name_ar','name_en',];
	protected $dates = ['created_at', 'updated_at',];
}
