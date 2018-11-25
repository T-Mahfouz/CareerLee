<?php

namespace App\Http\Controllers\Api;

use App\FeatureRequest;
use App\Http\Controllers\Controller;
use App\Job;
use App\JobInvitation;
use App\JobTag;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api','jwt.auth','activated','employer']);
    }

    public function addJob(Request $request)
    {
    	$user = Auth::user();
    	$notvalid = parent::JobValidator($request);
        if($notvalid){
            return parent::jsonResponse(400,$notvalid['en']);
        }

        $fileName = '';
        if($request->hasfile('image'))
        {
            $destination = public_path('images/jobs');
            $extension = $request->file('image')->getClientOriginalExtension();
            if(!in_array(strtolower($extension), ['jpg','jpeg','png'])){
                return parent::jsonResponse(400,parent::messages('error_image'));
            }
            $fileName = strtolower(rand(99999,99999999).uniqid().'.'.$extension);

            $moved = $request->file('image')->move($destination, $fileName);
        }

        $job = Job::create([
        	'user_id' => $user->id,
			'title' => $request->title,
			'address' => $request->address,
			'requirements' => $request->requirements,
			'description' => $request->description,
			'start_salary' => $request->start_salary,
			'final_salary' => $request->final_salary,
			'salary_per' => $request->salary_per,
			'featured' => 0,
			'image' => $fileName,
			'company_name' => $request->company_name,
        ]);

        $tags = explode(',', $request->tags);
    	if(count($tags)){
    		foreach($tags as $tag){
    			$item = trim($tag);
    			JobTag::create([
    				'job_id' => $job->id,
    				'tag' => $item
    			]);
    		}
    	}
    	$job['job_tags'] = $job->tags->pluck('tag');
    	unset($job['tags']);
    	
        $message = parent::messages('success_add');
    	return parent::jsonResponse(201,$message,$job);
    }
    public function sendJobInvitation(Request $request)
    {
    	$user = Auth::user();

    	$fullname = $request->employee_name;
		$number = $request->employee_number;

    	$employee = User::where([
    		'fullname' => $fullname,
    		'phone' => $number
    	])->first();

        if(!$employee){
        	$error_ar = 'غير موجود';
        	$error_en = 'This job seeker not found!';
            return parent::jsonResponse(404,$error_en);
        }
        if($employee->id == $user->id){
        	$error_ar = 'لا يمكنك إرسال دعوة لنفسك';
        	$error_en = 'You can\'t send invitation to yourself!';
            return parent::jsonResponse(400,$error_en);
        }

        $inviteBefore = JobInvitation::where([
            'employer_id' => $user->id,
            'employee_id' => $employee->id
        ])->first();
        if($inviteBefore){
            $error_ar = 'تم ارسال طلب من قبل';
            $error_en = 'You sent request before!';
            return parent::jsonResponse(400,$error_en);
        }

        $invitation = JobInvitation::create([
        	'employer_id' => $user->id,
			'employee_id' => $employee->id,
			'status' => 0,
        ]);
    	
        Notification::create([
            'user_id' => $employee->id,
            'content_ar' => 'قام '. $user->fullname.' بدعوتك إلى وظيفة جديدة',
            'content_en' => $user->fullname.' invited you to a new job' 
        ]);

        $title = 'New Job';
        $token = $employee->firebase;
        $body = $user->fullname.' invited you to a new job';
        $type = 'Realtime';
        parent::FCMPush($token,$title,$body,$type);

    	$invitation->employer;
    	$invitation->employee;

        $message = parent::messages('success_add');
    	return parent::jsonResponse(201,$message,$invitation);
    }
    public function addedJobs(Request $request)
    {
    	$user = Auth::user();
    	$jobs = $user->postedJobs;
    	if(count($jobs)){
    		foreach($jobs as $job){
    			if($job->image)
    				$job['image'] = url('/').'/images/jobs/'.$job->image;
    		}
    	}
    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$jobs);
    }
    public function sendFeatureRequest(Request $request)
    {
    	$user = Auth::user();
    	$jobID = $request->job_id;
    	$userJobs = $user->postedJobs->pluck('id')->toArray();
    	
    	if(!in_array($jobID, $userJobs)){
    		$error_ar = 'غير موجود';
    		$error_en = 'Job not found!';
    		return parent::jsonResponse(404,$error_en);
    	}
    	$sent = FeatureRequest::where([
    		'user_id' => $user->id,
			'job_id' => $jobID
    	])->first();
    	if($sent){
    		$error_ar = 'تم إرسال طلبك من قبل';
    		$error_en = 'Your request has been sent before!';
    		return parent::jsonResponse(400,$error_en);
    	}
    	FeatureRequest::create([
    		'user_id' => $user->id,
			'job_id' => $jobID,
			'status' => 0,
    	]);
    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message);
    }
    public function interestedJobs(Request $request)
    {
    	$user = Auth::user();
    	$myIndustries = $user->industries->pluck('industry_id')->toArray();

    	$allemployers = User::where('role_id',2)
    		//->where('id','!=',$user->id)
    		->get();

    	$list = [];

    	$employers = [];
    	$industriesIDs = array();
    	if(count($allemployers)){
    		foreach($allemployers as $employer){
    			if($employer->industries){
    				foreach($employer->industries as $indust){
    					if(in_array($indust->industry_id,$myIndustries)){
    						$employers[] = $employer;
    						if(count($employer->postedJobs)){
    							foreach($employer->postedJobs as $sj)
    								array_push($list, $sj);
    						}
    						break;
    					}
    				}
    			}
    		}
    	}

    	$flag = array();
		foreach ($list as $key => $row)
		{
			$flag[$key] = $row['created_at'];
		}
		array_multisort($flag, SORT_DESC, $list);
		
    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$list);
    }
}
