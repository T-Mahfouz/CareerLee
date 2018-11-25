<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Help;
use App\Industry;
use App\Http\Controllers\Controller;
use App\User;
use App\UserIndustry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            $message = parent::messages('credential_error');
            return $this->jsonResponse(401, $message);
        }

        $user = Auth::guard('api')->user();

        //$user->last_seen = Carbon::now();
        $user->firebase = $request->firebase;
        $user->update();

        $auth = $this->respondWithToken($token);
        $user['role_name'] = $user->role->name;
        unset($user['role']);
        $data = array_merge($user->toArray(), $auth);

        $message = parent::messages('success_process');
        return $this->jsonResponse(200, $message, $data);
    }
    public function signup(Request $request)
    {
        $notvalid = parent::UserValidator($request);
        if ($notvalid) {
            return parent::jsonResponse(400, $notvalid['ar']);
        }

        $lang = $request->has('lang')? $request->lang:'en';
        $job_match_notify = (int)$request->has('job_match_notify')? $request->job_match_notify:0;
        $job_expired_notify = (int)$request->has('job_expired_notify')? $request->job_expired_notify:0;
        $job_finder_notify = (int)$request->has('job_finder_notify')? $request->job_finder_notify:0;


        $fileName = 'default.png';
        if ($request->hasfile('image')) {
            $destination = public_path('images/users');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = strtolower(rand(99999, 99999999).uniqid().'.'.$extension);
            $request->file('image')->move($destination, $fileName);
        }

        $vc = $this->generateCode(4);

        $user = User::create([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'email' => $request->email,
            'image' => $fileName,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
            'firebase' => $request->firebase,
            'status' => 0,
            'code' => $vc,
            'lang' => $lang,
            'job_match_notify' => $job_match_notify,
            'job_expired_notify' => $job_expired_notify,
            'job_finder_notify' => $job_finder_notify,
            'role_id' => (int)$request->role_id,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'driving_license' => (int)$request->driving_license,
            #'last_seen' => Carbon::now(),
        ]);

        $message = 'Careerlee code: '.$vc;
        parent::sendSMS($message, $request->phone);

        $token = Auth::guard('api')->login($user);

        $data = array_merge($user->toArray(), $this->respondWithToken($token));

        $message = parent::messages('success_signup');
        return $this->jsonResponse(200, $message, $data);
    }
    public function forgetPassword(Request $request)
    {
        $digits = 4;
        $vc = parent::generateCode(4);
        $message = 'Careerlee code: '.$vc;

        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if (!$phone) {
            $error_ar = 'يجب إدخال رقم الهاتف.';
            $error_en = 'Enter your phone number!';
            return parent::jsonResponse(400, $error_en);
        }
        if (!$user) {
            $error_ar = 'هذا الحساب غير موجود.';
            $error_en = 'User not found!';
            return parent::jsonResponse(404, $error_en);
        }

        $user->code = $vc;
        $user->update();

        $check = parent::sendSMS($message, $phone);
        if ($check) {
            $mesage_ar = 'تم إرسال كود التفعيل.';
            $mesage_en = 'Code has been sent.';
            return parent::jsonResponse(200, $mesage_en);
        }
    }
    public function changePassword(Request $request)
    {
        $phone = $request->phone;
        if (!$phone) {
            $error_ar = 'يجب إدخال رقم الهاتف.';
            $error_en = 'Enter your phone number!';
            return parent::jsonResponse(400, $error_en);
        }
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            $error_ar = 'هذا الحساب غير موجود.';
            $error_en = 'User not found!';
            return parent::jsonResponse(404, $error_en);
        }

        $savedVC = $user->code;
        $receivedVC = $request->code;
        $password = bcrypt($request->password);

        $notvalid = $this->verifyPassword($request);
        if ($notvalid) {
            return parent::jsonResponse(400, $notvalid['en']);
        }
        if ($savedVC != $receivedVC) {
            $error_ar = 'الكود غير صحيح.';
            $error_en = 'Wrong code!';
            return parent::jsonResponse(400, $error_en);
        }
        $user->status = 1;
        $user->code = null;
        $user->password = $password;
        $user->update();


        $message_ar = 'تم تغيير كلمة المرور.';
        $message_en = 'Successful operation.';
        return parent::jsonResponse(200, $message_en);
    }
    public function verifyPassword(Request $request)
    {
        $validationErrors = array();
        $passvalidator = Validator::make(
            $request->only('password'),
            ['password' => 'required|string|min:4']
        );

        if ($passvalidator->fails()) {
            $errors=$passvalidator->errors()->toArray();
            $validationErrors['ar'] = 'كلمة المرور يجب أن تكون 4 حروف على الأقل';
            $validationErrors['en'] = 'Password must be 4 characters as minimum!';
        }
        return $validationErrors;
    }
    public function aboutus(Request $request)
    {
        $about = About::first();
        if (!$about) {
            $about = [];
        }
        $message = parent::messages('success_process');
        return parent::jsonResponse(200, $message, $about);
    }
    public function help(Request $request)
    {
        $help = Help::first();
        if (!$help) {
            $help = [];
        }
        $message = parent::messages('success_process');
        return parent::jsonResponse(200, $message, $help);
    }
    public function industries(Request $request)
    {
        $industries = Industry::all();
        $message = parent::messages('success_process');
        return parent::jsonResponse(200, $message, $industries);
    }
    public function getCode(Request $request)
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        return parent::jsonResponse(200,'Done',$user->code);

    }
    public function suggestedIndustries(Request $request)
    {
        $items = $request->items ? $request->items : 3;
        $IDs = UserIndustry::select(DB::raw('count(*) as total'),'industry_id')->groupBy('industry_id')->orderBy('total','DESC')->take($items)->get()->pluck('industry_id');
        $common = Industry::whereIn('id',$IDs)->get();
        if(!count($common)) {
            $common = Industry::take($items)->get();
        }
        return parent::jsonResponse(200,'Done',$common);
    }
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 3600
        ];
    }
}
