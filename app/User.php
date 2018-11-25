<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    ########## Relations
    public function role(){
        return $this->belongsTo(\App\Role::class,'role_id');
    }
    /*public function gender(){
        return $this->belongsTo(\App\Gender::class,'gender_id');
    }
    public function marital(){
        return $this->belongsTo(\App\Marital::class,'marital_id');
    }*/
    public function postedJobs(){
        return $this->hasMany(\App\Job::class,'user_id');
    }
    public function appliedJobs(){
        return $this->hasMany(\App\AppliedJob::class,'user_id');
    }
    public function viewedJobs(){
        return $this->hasMany(\App\JobView::class,'user_id');
    }
    public function favourites(){
        return $this->hasMany(\App\Favourite::class,'user_id');
    }
    public function courses(){
        return $this->hasMany(\App\Course::class,'user_id');
    }    
    public function experiences(){
        return $this->hasMany(\App\Experience::class,'user_id');
    }
    public function languages(){
        return $this->hasMany(\App\UserLanguage::class,'user_id');
    }
    public function industries(){
        return $this->hasMany(\App\UserIndustry::class,'user_id');
    }
    public function preferences(){
        return $this->hasMany(\App\UserPreference::class,'user_id');
    }
    public function skills(){
        return $this->hasMany(\App\Skill::class,'user_id');
    }
    public function education(){
        return $this->hasMany(\App\UserEducation::class,'user_id');
    }
    public function notifications(){
        return $this->hasMany(\App\Notification::class,'user_id');
    }
    public function JobOffers(){
        return $this->hasMany(\App\JobInvitation::class,'employer_id');
    }
    public function JobInvitations(){
        return $this->hasMany(\App\JobInvitation::class,'employee_id');
    }
    public function locations(){
        return $this->hasMany(\App\UserLocation::class,'user_id');
    }
    
    
    ########## Methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    ############ Protected
    protected $fillable = [
        'fullname','role_id','gender','marital_status','nationality','driving_license','status','address','image','phone','email','password','lang','bio','code','job_match_notify','job_expired_notify','job_finder_notify','birth_date','min_company_size','max_company_size','company_location',
    ];
    protected $hidden = ['password', 'remember_token','code',];
    protected $dates = ['created_at', 'updated_at','birth_date',];
}
