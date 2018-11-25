<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function(){


	################ User
	Route::post('me', 'Api\UserController@me');
	Route::post('editprofile', 'Api\UserController@editProfile');
	Route::post('activateaccount','Api\UserController@activateAccount');
	Route::get('resendvc','Api\UserController@resendVC');
	Route::post('rate', 'Api\UserController@rate');
	Route::post('refresh', 'Api\UserController@refresh');
	Route::get('notifications', 'Api\UserController@notifications');
	Route::get('timeline', 'Api\UserController@timeline');
	Route::get('search', 'Api\UserController@search');
	Route::get('jobinfo', 'Api\UserController@jobInfo');



	################ Employer
	Route::post('addjob', 'Api\EmployerController@addJob');
	Route::get('addedjobs', 'Api\EmployerController@addedJobs');
	Route::post('sendinvitation', 'Api\EmployerController@sendJobInvitation');
	Route::get('sendfeaturerequest', 'Api\EmployerController@sendFeatureRequest');
	Route::get('interestedjobs', 'Api\EmployerController@interestedJobs');



	################ Employee
	Route::get('interested', 'Api\EmployeeController@interestedJobs');
	Route::get('viewedjobs', 'Api\EmployeeController@viewedJobs');
	Route::get('appliedjobs', 'Api\EmployeeController@appliedJobs');
	Route::get('applytojob', 'Api\EmployeeController@applyToJob');
	Route::get('addtofavourites', 'Api\EmployeeController@addToFavourites');
	Route::get('myfavouritelist', 'Api\EmployeeController@myFavouriteList');
	Route::get('claimrequests', 'Api\EmployeeController@claimRequests');





	Route::get('logout','Api\UserController@logout');
});

Route::post('login','Api\PublicController@login')->name('login');
Route::post('signup','Api\PublicController@signup');
Route::post('forgetpassword','Api\PublicController@forgetPassword');
Route::post('changepassword','Api\PublicController@changePassword');
Route::get('aboutus','Api\PublicController@aboutus');
Route::get('help','Api\PublicController@help');
Route::get('industries','Api\PublicController@industries');
Route::get('getcode','Api\PublicController@getCode');
Route::get('suggestedIndustries','Api\PublicController@suggestedIndustries');
