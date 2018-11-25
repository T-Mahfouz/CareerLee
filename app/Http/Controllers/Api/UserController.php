<?php

namespace App\Http\Controllers\Api;

use App\AppRate;
use App\Course;
use App\Experience;
use App\Http\Controllers\Controller;
use App\Job;
use App\JobTag;
use App\JobView;
use App\Notification;
use App\Skill;
use App\User;
use App\UserEducation;
use App\UserIndustry;
use App\UserLanguage;
use App\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api','jwt.auth','activated'])->except([
        	'activateAccount','resendVC'
        ]);
    }

    public function refresh(Request $request)
    {
    	return Auth::refresh();
    	return $this->respondWithToken(Auth::refresh());
    }
    public function me()
    {
        return response()->json(Auth::user());
    }
    public function editProfile(Request $request)
    {
    	//return $request->all();

        $user = Auth::user();

        $fullname = $request->has('fullname')?$request->fullname:$user->fullname;
        $job_match_notify = $request->has('job_match_notify')?$request->job_match_notify:$user->job_match_notify;
        $job_expired_notify = $request->has('job_expired_notify')?$request->job_expired_notify:$user->job_expired_notify;
        $job_finder_notify = $request->has('job_finder_notify')?$request->job_finder_notify:$user->job_finder_notify;
        $address = $request->has('address')?$request->address:$user->address;
        $password = $request->has('password')?$request->password:$user->password;
        $nationality = $request->has('nationality')?$request->nationality:$user->nationality;
        $marital_status = $request->has('marital_status')?$request->marital_status:$user->marital_status;
        $driving_license = $request->has('driving_license')?$request->driving_license:$user->driving_license;
        $phone = $request->has('phone')?$request->phone:$user->phone;
        $email = $request->has('email')?$request->email:$user->email;
        $bio = $request->has('bio')?$request->bio:$user->bio;
        $lang = $request->has('lang')?$request->lang:$user->lang;
        $birth_date = $request->has('birth_date')?$request->birth_date:$user->birth_date;
        $gender = $request->has('gender')?$request->gender:$user->gender;
        $min_company_size = $request->has('min_company_size')?$request->min_company_size:$user->min_company_size;
        $max_company_size = $request->has('max_company_size')?$request->max_company_size:$user->max_company_size;
        
        $company_location = $request->has('company_location')?$request->company_location:$user->company_location;

        $role_id = $request->has('role_id')?$request->role_id:$user->role_id;
        //$bd = $birth_date->format('Y-m-d');

        $plainpass = $request->password;

        $request->merge([
            'id' => $user->id,
            'fullname' => $fullname,
            // 'address' => $address,
            // 'email' => $email,
            'password' => $password,
            'phone' => $phone,
            // 'driving_license' => $driving_license,
            // 'marital_id' => $marital_id,
            // 'nationality' => $nationality,
            // 'lang' => $lang,
            // 'gender_id' => $gender_id,
            'role_id' => $role_id,
            // 'birth_date' => $bd,
        ]);

        $notvalid = parent::UserValidator($request);
        if($notvalid){
            return parent::jsonResponse(400,$notvalid['en']);
        }

        $fileName = $oldImage = $user->image;
        if($request->hasfile('image'))
        {
            $destination = public_path('images/users');
            $extension = $request->file('image')->getClientOriginalExtension();
            if(!in_array(strtolower($extension), ['jpg','jpeg','png'])){
                return parent::jsonResponse(400,parent::messages('error_image'));
            }
            $fileName = strtolower(rand(99999,99999999).uniqid().'.'.$extension);

            $moved = $request->file('image')->move($destination, $fileName);
            if($moved && ($oldImage != 'default.png')){
                if(file_exists($destination.'/'.$oldImage))
                    unlink($destination.'/'.$oldImage);
            }
        }

        $user->fullname = $fullname;
        $user->address = $address;
        $user->phone = $phone;
        $user->email = $email;
        $user->lang = $lang;
        $user->gender = $gender;
        $user->role_id = $role_id;
        $user->driving_license = $driving_license;
        $user->marital_status = $marital_status;
        $user->image = $fileName;
        $user->birth_date = $birth_date;
        $user->bio = $bio;
        $user->min_company_size = $min_company_size;
        $user->max_company_size = $max_company_size;
		$user->job_match_notify = $job_match_notify;
        //$user->company_location = $company_location;
		$user->job_expired_notify = $job_expired_notify;
		$user->job_finder_notify = $job_finder_notify;

        if($plainpass)
        	$password = bcrypt($plainpass);
        $user->password = $password;

        $user->update();

        if($request->education)
        foreach ($request->education as $education) {
        	$education = (object)$education;

        	$notvalid = parent::EducationValidator($education);
        	if($notvalid){
        		return parent::jsonResponse(400,$notvalid['en']);
        	}
        	UserEducation::create([
        		'user_id' => $user->id,
        		'institution' => $education->institution,
        		'degree' => $education->degree,
        		'start_at' => $education->start_at,
        		'end_at' => $education->end_at,
        	]);
        }
        	
       	if($request->courses)	
        foreach ($request->courses as $course) {
        	$course = (object)$course;
        	if($course->course && $course->duration){
        		$courseExists = Course::where([
		        	'user_id' => $user->id,
		        	'course' => $course->course,
		        	'duration' => $course->duration,
		        ])->first();
		        if(!$courseExists){
		        	Course::create([
		        		'user_id' => $user->id,
		        		'course' => $course->course,
		        		'duration' => $course->duration,
		        	]);
		        }
        	}
        }

        if($request->experiences)
        foreach ($request->experiences as $experience) {
        	$experience = (object)$experience;
        	$notvalid = parent::ExperienceValidator($experience);
        	if($notvalid){
        		return parent::jsonResponse(400,$notvalid['en']);
        	}
        	$cimage = '';
        	if($request->hasfile('company_image'))
        	{
        		$destination = public_path('images/experiences');
        		$extension = $request->file('image')->getClientOriginalExtension();
        		if(!in_array(strtolower($extension), ['jpg','jpeg','png'])){
        			return parent::jsonResponse(400,parent::messages('error_image'));
        		}
        		$cimage = strtolower(rand(99999,99999999).uniqid().'.'.$extension);

        		$moved = $request->file('image')->move($destination, $cimage);
        	}

	        Experience::create([
	        	'user_id' => $user->id,
	        	'position' => $experience->position,
	        	'company_name' => $experience->company_name,
	        	'from' => $experience->from,
	        	'to' => $experience->to,
	        	'current' => $experience->current,
	        	'company_image' => $cimage,
	        ]);
    	}

    	if($request->skills)
    	foreach ($request->skills as $skill) {
    		if($skill){
    			$skillExists = Skill::where([
		        	'user_id' => $user->id,
		        	'skill' => $skill
		        ])->first();
		        if(!$skillExists){
		        	Skill::create([
		        		'user_id' => $user->id,
		        		'skill' => $skill,
		        	]);
		        }
    		}
	    }

	    if($request->locations)
    	foreach ($request->locations as $location) {
    		if($location){
    			$locationExist = UserLocation::where([
		        	'user_id' => $user->id,
		        	'location' => $location
		        ])->first();
		        if(!$locationExist){
		        	UserLocation::create([
		        		'user_id' => $user->id,
		        		'location' => $location,
		        	]);
		        }
    		}   
	    }

	    if($request->languages)
	    foreach ($request->languages as $language) {
	    	if($language){
	    		$langExists = UserLanguage::where([
		        	'user_id' => $user->id,
		        	'language' => $language,
		        ])->first();
		        if(!$langExists){
		        	UserLanguage::create([
		        		'user_id' => $user->id,
		        		'language' => $language,
		        	]);
		        }
	    	}
    	}

    	if(count($request->available_industries))
	    foreach ($request->available_industries as $industry) {
	    	if($industry){
	    		$indExist = UserIndustry::where([
		        	'user_id' => $user->id,
		        	'industry_id' => $industry,
		        ])->first();
	    		if(!$indExist){
	    			UserIndustry::create([
			        	'user_id' => $user->id,
			        	'industry_id' => $industry,
		        	]);
	    		}
	    	}
    	}

    	$user->courses;
		$user->experiences;
		$user->languages;
		$user->skills;
		$user->education;
		$user->industries;
		$user->locations;

        $message = parent::messages('success_edit_profile');
        return $this->jsonResponse(200,$message,$user);
    }
    public function activateAccount(Request $request)
    {
        $user = Auth::user();
        $savedVC = $user->code;
        $receivedVC = $request->code;

        if($savedVC != $receivedVC){
        	$error_ar = 'كود التفعيل غير صحيح.';
        	$error_en = 'The code is wrong!';
            return parent::jsonResponse(400,$error_en);
        }
        $user->status = 1;
        $user->code = null;
        $user->update();

        $mesage_ar = 'تم تفعيل الحساب.';
        $mesage_en = 'Account has been activated.';

        return parent::jsonResponse(200,$mesage_en);
    }
    public function resendVC(Request $request)
    {
        $user = Auth::user();
        if($user->status == 1){
        	$error_ar = 'الحساب مُفعل.';
        	$error_en = 'Account is already activated!';
            return parent::jsonResponse(400,$error_en);
        }

        $vc = parent::generateCode(4);
        $message = 'Careerlee code: '.$vc;

        if($user->verification_code != null){
        	$message = $user->verification_code;
        }

        $user->code = $vc;
        $user->update();

        $check = parent::sendSMS($message,$user->phone);
        if($check){
        	$mesage_ar = 'تم إرسال كود التفعيل.';
       		$mesage_en = 'Activation code has been sent.';
        	return parent::jsonResponse(200,$mesage_en);
        }
    }
    public function rate(Request $request)
    {
        $user = Auth::user();

        $rated = AppRate::where('user_id',$user->id)->first();
        if($rated){
        	$error_ar = 'تم التقييم من قبل';
        	$error_en = 'Rated before';
            return parent::jsonResponse(400,$error_en);
        }
        return 'Not Good';       
        $rate = (float)$request->rate;

        if(!$rate || $rate > 5 || $rate < 0)
            return parent::jsonResponse(400,parent::messages('error_rate_value'));

        AppRate::create([
            'user_id' => $user->id,
            'rate' => $rate,
        ]);

        return parent::jsonResponse(200,parent::messages('success_process'));
    }
    public function notifications(Request $request)
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id',$user->id)->orderBy('created_at','DESC')->get();

        $message = parent::messages('success_process');
        return parent::jsonResponse(200,$message,$notifications);
    }
    public function timeline(Request $request)
    {
    	$user = Auth::user();

    	$jobs = Job::orderBy('featured','DESC')->orderBy('created_at','DESC')->get();
    	if(count($jobs)){
    		foreach($jobs as $job){
    			if($job->image)
    				$job['image'] = url('/').'/images/jobs/'.$job->image;
    		}
    	}
    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$jobs);
    }
    public function search(Request $request)
    {
    	$key = $request->key;
    	$search_type = $request->type;
    	$result = [];
    	switch($search_type){
    		case 'jobs':{
    			$jobIDs = array();
    			$tags = JobTag::where('tag','LIKE','%'.$key.'%')->get();
    			if(count($tags)){
    				foreach($tags as $tag)
    					$jobIDs[] = $tag->job_id;
    			}
    			$jobs = Job::where('title','LIKE','%'.$key.'%')->get();
    			if(count($jobs)){
    				foreach($jobs as $job)
    					$jobIDs[] = $job->id;
    			}
    			$jobIDs = array_unique($jobIDs);
    			$result = Job::whereIn('id',$jobIDs)->orderBy('created_at','DESC')->get();
    			if(count($result)){
    				foreach($result as $item){
    					$item['job_tags'] = $item->tags->pluck('tag');
    					unset($item['tags']);
    				}
    			}
    		}break;
    		case 'people':{
    			$result = User::where('fullname','LIKE','%'.$key.'%')->get();
    		}break;
    		case 'all':{
    			$people = User::where('fullname','LIKE','%'.$key.'%')->get()->toArray();

    			$jobIDs = array();
    			$tags = JobTag::where('tag','LIKE','%'.$key.'%')->get();
    			if(count($tags)){
    				foreach($tags as $tag)
    					$jobIDs[] = $tag->job_id;
    			}
    			$jobs = Job::where('title','LIKE','%'.$key.'%')->get();
    			if(count($jobs)){
    				foreach($jobs as $job)
    					$jobIDs[] = $job->id;
    			}
    			$jobIDs = array_unique($jobIDs);
    			$resultJobs = Job::whereIn('id',$jobIDs)->orderBy('created_at','DESC')->get();
    			if(count($resultJobs)){
    				foreach($resultJobs as $item){
    					$item['job_tags'] = $item->tags->pluck('tag');
    					unset($item['tags']);
    				}
    			}
    			$resultJobs = $resultJobs->toArray();
    			$result = array_merge($people,$resultJobs);
    		}break;
    		default:{
    			$people = User::where('fullname','LIKE','%'.$key.'%')->get()->toArray();

    			$jobIDs = array();
    			$tags = JobTag::where('tag','LIKE','%'.$key.'%')->get();
    			if(count($tags)){
    				foreach($tags as $tag)
    					$jobIDs[] = $tag->job_id;
    			}
    			$jobs = Job::where('title','LIKE','%'.$key.'%')->get();
    			if(count($jobs)){
    				foreach($jobs as $job)
    					$jobIDs[] = $job->id;
    			}
    			$jobIDs = array_unique($jobIDs);
    			$resultJobs = Job::whereIn('id',$jobIDs)->orderBy('featured','DESC')->orderBy('created_at','DESC')->get();
    			if(count($resultJobs)){
    				foreach($resultJobs as $item){
    					$item['job_tags'] = $item->tags->pluck('tag');
    					unset($item['tags']);
    				}
    			}
    			$resultJobs = $resultJobs->toArray();
    			$result = array_merge($people,$resultJobs);
    		}break;
    	}

    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$result);
    }
    public function jobInfo(Request $request)
    {
    	$user = Auth::user();
    	$jobID = $request->job_id;
    	$job = Job::find($jobID);
    	if(!$job){
    		$error_ar = 'غير موجودة';
	    	$error_en = 'Job not found!';
	    	return parent::jsonResponse(404,$error_en);
    	}

    	$viewed = JobView::where([
    		'user_id' => $user->id,
    		'job_id' => $jobID
    	])->first();
    	if(!$viewed){
    		JobView::create([
    			'user_id' => $user->id,
    			'job_id' => $jobID
    		]);
    	}

    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$job);
    }
    

	###########################################
    protected function respondWithToken($token)
    {
        return [
        	'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 3600
        ];
    }
    public function logout()
    {
        $user = Auth::user();
        $user->last_seen = Carbon::now();
        $user->update();

        Auth::logout();

        $message = 'تم تسجيل الخروج بنجاح';
        return $this->jsonResponse(200,$message);
    }
}
