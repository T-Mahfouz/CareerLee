<?php

namespace App\Http\Controllers\Api;

use App\AppliedJob;
use App\Favourite;
use App\Http\Controllers\Controller;
use App\Job;
use App\JobInvitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api','jwt.auth','activated','employee']);
    }

    public function interestedJobs(Request $request)
    {
    	$user = Auth::user();
    	$myIndustries = $user->industries->pluck('industry_id')->toArray();

    	$allemployers = User::where('role_id',2)->get();

    	$list = [];

    	$employers = [];
    	$industriesIDs = array();
    	if(count($allemployers)){
    		foreach($allemployers as $employer){
    			if($employer->industries){
    				foreach($employer->industries as $indust){
    					if(in_array($indust->industry_id,$myIndustries)){
    						if(($user->min_company_size <= $employer->min_company_size) && ($user->max_company_size <= $employer->max_company_size) ){
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
    public function viewedJobs(Request $request)
    {
    	$user = Auth::user();
    	$viewed = array();
    	$viewedEloquent = $user->viewedJobs;
    	if(count($viewedEloquent)){
    		foreach($viewedEloquent as $item){
    			$job = Job::find($item->job_id);
    			$job['viewed_at'] = $job->created_at;
    			$viewed[] = $job;
    		}
    	}
    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$viewed);
    }
    public function appliedJobs(Request $request)
    {
    	$user = Auth::user();
    	$applied = array();
    	$appliedIDs = $user->appliedJobs;
    	if(count($appliedIDs)){
    		foreach($appliedIDs as $item){
    			$job = Job::find($item->job_id);
    			$job['applied_at'] = $item->created_at;
    			$applied[] = $job;
    		}
    	}
    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message,$applied);
    }
    public function applyToJob(Request $request)
    {
    	$user = Auth::user();
    	$jobID = $request->job_id;
    	$job = Job::find($jobID);
    	if(!$job){
    		$error_ar = 'غير موجودة';
	    	$error_en = 'Job not found!';
	    	return parent::jsonResponse(404,$error_en);
    	}
    	$appliedBefore = AppliedJob::where([
    		'user_id' => $user->id,
    		'job_id' => $jobID
    	])->first();
    	if($appliedBefore){
    		$error_ar = 'تم التقدم لهذه الوظيفة من قبل';
	    	$error_en = 'You applied this job before!';
	    	return parent::jsonResponse(400,$error_en);
    	}
    	AppliedJob::create([
    		'user_id' => $user->id,
    		'job_id' => $jobID
    	]);

    	$message = parent::messages('success_process');
    	return parent::jsonResponse(200,$message);
    }
    public function addToFavourites(Request $request)
    {
        $user = Auth::user();
        $jobID = $request->job_id;
        $job = Job::find($jobID);
        if(!$job){
    		$error_ar = 'غير موجودة';
	    	$error_en = 'Job not found!';
	    	return parent::jsonResponse(404,$error_en);
    	}

        $isFavourite = 0;

        $favourite = Favourite::where([
            'user_id' => $user->id,
            'job_id' => $jobID
        ])->first();

        if($favourite)
        {
            $favourite->delete();
        }
        else{
            Favourite::create([
                'user_id' => $user->id,
                'job_id' => $jobID,
            ]);
            $isFavourite = 1;
        }        
        
        $job['is_favourite'] = $isFavourite;

        $favourites = [];
        $favouritesEloquent = $user->favourites;
        if(count($favouritesEloquent)){
        	foreach($favouritesEloquent as $item){
        		$favourites[] = Job::find($item->job_id);
        	}
        }

        $message = parent::messages('success_process');
        return parent::jsonResponse(200,$message,$favourites);
    }
    public function myFavouriteList(Request $request)
    {
        $user = Auth::user();

        $favourites = [];
        $favouritesEloquent = $user->favourites;
        if(count($favouritesEloquent)){
        	foreach($favouritesEloquent as $item){
        		$favourites[] = Job::find($item->job_id);
        	}
        }

        $message = parent::messages('success_process');
        return parent::jsonResponse(200,$message,$favourites);
    }
    public function claimRequests(Request $request)
    {
        $user = Auth::user();

        $requests = JobInvitation::where('employee_id',$user->id)->get();
        if(count($requests)){
        	foreach ($requests as $item){
        		$item['employer'] = User::find($item->employer_id);
        	}
        }

        $message = parent::messages('success_process');
        return parent::jsonResponse(200,$message,$requests);
    }

}
