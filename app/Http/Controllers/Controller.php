<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function jsonResponse($code,$message,$data=[],$jcode=0)
	{
		if($jcode == 0)
			$jcode = $code;
		return response()->json([
			'code' => $code,
			'message' => $message,
			'data' => $data
		],$jcode);
	}

	public static function generateCode($digits)
    {
    	$digits = (int)$digits;
        $vc = rand(pow(10, $digits-1), pow(10, $digits)-1);
        return $vc;
    }
    
	public static function UserValidator(Request $request)
	{
		$validationErrors = [];
		$fullnameValidator = Validator::make($request->only('fullname'), 
			['fullname' => 'required|string|max:255|min:2']);

		if($fullnameValidator->fails())
		{
			$errors = $fullnameValidator->errors()->toArray();
			$validationErrors['ar'] = 'الاسم غير صالح';
			$validationErrors['en'] = 'Fullname not valid!';
		}
		/* ============ Address ========== */
		/*$addressValidator = Validator::make($request->only('address'), 
			['address' => 'required|string|min:5']);

		if($addressValidator->fails())
		{
			$errors = $addressValidator->errors()->toArray();
			$validationErrors['ar'] = 'اعنوان فير صالح';
			$validationErrors['en'] = 'Address not valid!';
		}*/
		
		/* ============ Phone ========== */
		$phonevalidator = Validator::make($request->only('phone'),
			['phone' => 'digits_between:11,14|unique:users,phone,'.$request->id]);
		
		if($phonevalidator->fails())
		{
			$errors=$phonevalidator->errors()->toArray();
			$validationErrors['ar'] = 'رقم الجوال غير صحيح أو موجود بالفعل';
			$validationErrors['en'] = 'Phone not valid or has been taken before!'; 
		}
		/* ============ Email ========== */
		/*$emailvalidator = Validator::make($request->only('email'),
			['email' => 'required|email|unique:users,email,'.$request->id]);
		
		if($emailvalidator->fails())
		{
			$errors=$emailvalidator->errors()->toArray();
			$validationErrors['ar'] = 'البريد الإلكترونى غير صحيح أو موجود بالفعل';
			$validationErrors['en'] = 'Email not valid or has been taken before!'; 
		}*/
		/* ============ Password ========== */
		$passwordvalidator = Validator::make($request->only('password'), 
			['password' => 'required|min:4']);
		if($passwordvalidator->fails())
		{
			$errors=$passwordvalidator->errors()->toArray();
			$validationErrors['ar'] = 'كلمة المرور يجب أن تكون 4 حروف على الأقل';
			$validationErrors['en'] = 'Password must be 4 characters as minimum!'; 
		}
		/* ============ BirthDate ========== */
		/*$birthdatevalidator = Validator::make($request->only('birth_date'),
			['birth_date' => 'required:date|date_format:Y-m-d']);
		
		if($birthdatevalidator->fails())
		{
			$errors=$birthdatevalidator->errors()->toArray();
			$validationErrors['ar'] = 'يجب تحديد تاريخ الميلاد';
			$validationErrors['en'] = 'Identify your Birth date!'; 
		}*/
		/* ============ Role_id ========== */
		$rolevalidator = Validator::make($request->only('role_id'),
			['role_id' => 'required']);
		
		if($rolevalidator->fails())
		{
			$errors=$rolevalidator->errors()->toArray();
			$validationErrors['ar'] = 'يجب تحديد نوع الحساب ';
			$validationErrors['en'] = 'Identify your account Employer or job seeker!'; 
		}
		/* ============ Gender_id ========== */
		/*$gendervalidator = Validator::make($request->only('gender_id'),
			['gender_id' => 'required']);
		
		if($gendervalidator->fails())
		{
			$errors=$gendervalidator->errors()->toArray();
			$validationErrors['ar'] = 'يجب تحديد النوع';
			$validationErrors['en'] = 'Identify your gender!'; 
		}*/
		/* ============ Marital_id ========== */
		/*$maritalvalidator = Validator::make($request->only('marital_id'),
			['marital_id' => 'required']);
		
		if($maritalvalidator->fails())
		{
			$errors=$maritalvalidator->errors()->toArray();
			$validationErrors['ar'] = 'برجاء تحديد الحالة الإجتماعية';
			$validationErrors['en'] = 'Identify your marital status!'; 
		}*/
		/* ============ Nationality ========== */
		/*$maritalvalidator = Validator::make($request->only('nationality'),
			['nationality' => 'required|string']);
		
		if($maritalvalidator->fails())
		{
			$errors=$maritalvalidator->errors()->toArray();
			$validationErrors['ar'] = 'برجاء تحديد الجنسية';
			$validationErrors['en'] = 'Identify your nationality!'; 
		}*/
		/* ============ Driving_license ========== */
		/*$drivinglicensevalidator = Validator::make($request->only('driving_license'),
			['driving_license' => 'required|string']);
		
		if($drivinglicensevalidator->fails())
		{
			$errors=$drivinglicensevalidator->errors()->toArray();
			$validationErrors['ar'] = 'هل لديك رخصة قيادة؟';
			$validationErrors['en'] = 'Do you\'ve driving license?'; 
		}*/
		
		return $validationErrors;
	}

	public static function JobValidator(Request $request)
	{
		$validationErrors = [];
		$validator = Validator::make($request->only('title'), 
			['title' => 'required|string|min:5']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'العنوان غير صالح';
			$validationErrors['en'] = 'Title not valid!';
		}
		/* ============ Address ========== */
		$validator = Validator::make($request->only('address'), 
			['address' => 'required|string|min:5']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'اعنوان فير صالح';
			$validationErrors['en'] = 'Address not valid!';
		}
		/* ============ Requirements ========== */
		$validator = Validator::make($request->only('requirements'), 
			['requirements' => 'required|string|min:25']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'رجاء تحديد المطلوب فى هذه الوظيفة';
			$validationErrors['en'] = 'Requirements not valid!';
		}
		/* ============ Description ========== */
		$validator = Validator::make($request->only('description'), 
			['description' => 'required|string|min:25']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'رجاء تحديد وصف شامل لهذه الوظيفة';
			$validationErrors['en'] = 'Description not valid!';
		}
		/* ============ Start Salary ========== */
		$validator = Validator::make($request->only('start_salary'), 
			['start_salary' => 'required|numeric']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'برجاء تحديد  الحد الأدنى للمرتب ';
			$validationErrors['en'] = 'Start salary not valid!';
		}
		/* ============ Final Salary ========== */
		$validator = Validator::make($request->only('final_salary'), 
			['final_salary' => 'required|numeric']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'برجاء تحديد  الحد الأقصى للمرتب ';
			$validationErrors['en'] = 'Final salary not valid!';
		}
		/* ============ Salary Per ========== */
		$validator = Validator::make($request->only('salary_per'), 
			['salary_per' => 'required|string']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'برجاء تحديد المدة لهذا الراتب ';
			$validationErrors['en'] = 'Duration for salary not valid!';
		}
		/* ============ Company Name ========== */
		$validator = Validator::make($request->only('company_name'), 
			['company_name' => 'required|string|min:2']);

		if($validator->fails())
		{
			$errors = $validator->errors()->toArray();
			$validationErrors['ar'] = 'اسم الشركة غير صالح';
			$validationErrors['en'] = 'Company name not valid!';
		}
		
		return $validationErrors;
	}

	public static function EducationValidator($request)
	{
		$validationErrors = [];
		if($request->institution == null || strlen($request->institution) < 2)
		{
			$validationErrors['ar'] = 'مكان الدراسة غير صالح';
			$validationErrors['en'] = 'Institution not valid!';
		}
		/* ============ Degree ========== */
		if($request->degree == null)
		{
			$validationErrors['ar'] = 'يرجى ادخال الدرجة';
			$validationErrors['en'] = 'Degree not valid!';
		}
		/* ============ Start ========== */
		if($request->start_at == null)
		{
			$validationErrors['ar'] = 'تاريخ غير صالح';
			$validationErrors['en'] = 'Start date not valid!';
		}
		/* ============ End ========== */
		if($request->end_at == null)
		{
			$validationErrors['ar'] = 'تاريخ غير صالح';
			$validationErrors['en'] = 'End date not valid!';
		}
		
		return $validationErrors;
	}

	public static function ExperienceValidator($request)
	{
		$validationErrors = [];
		if($request->position == null || strlen($request->position) < 2)
		{
			$validationErrors['ar'] = 'المنصب  غير صالح';
			$validationErrors['en'] = 'Position not valid!';
		}
		/* ============ company_name ========== */
		if($request->company_name == null)
		{
			$validationErrors['ar'] = 'اسم الشركة غير صالح';
			$validationErrors['en'] = 'Company name not valid!';
		}
		/* ============ Start ========== */
		if($request->from == null)
		{
			$validationErrors['ar'] = 'تاريخ غير صالح';
			$validationErrors['en'] = 'Start date not valid!';
		}
		/* ============ End ========== */
		if($request->to == null)
		{
			$validationErrors['ar'] = 'تاريخ غير صالح';
			$validationErrors['en'] = 'End date not valid!';
		}
		
		return $validationErrors;
	}

	public static function FCMPush($tokens,$title,$body,$type,$data=[])
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$data = array(
			"title" => $title,
			"body"  => $body,
			"type"  => $type,
			"data"  => $data,
			'content_available'=> true,
			'vibrate' => 1,
			'sound' => true,
			'priority'=> 'high'
		);
		$fields = array(
			'to' =>$tokens,
			'notification' => $data
		);
		$headers = array(
			'AAAAU-MITq0:APA91bESlPtTgGwdjs7iDpH9qLyFkUHpw9GKXvTtKPa-BGrmuaKsmskY9Il6CxkWYuKPWrA5vk4Sf20vI1iBDx1s8O1-ZPYqrtv-202UfbmqzBiVnZPrXF32gMmfWT2hpDZEig8SaYl-',
			'Content-Type:application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL,$url);
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		if($result === false)
			die('cUrl faild: '.curl_error($ch));
		curl_close($ch);
		return $result;    
	}

	public static function messages($code)
	{
		$messages = [
			'success_add' => 'تمت الإضافة بنجاح',
			'success_process' => 'تمت العملية بنجاح',
			'success_signup' => 'تم الاشتراك بنجاح',
			'success_edit_profile' => 'تم التعديل بنجاح',
			'success_message_sent' => 'تم إرسال الرسالة بنجاح',
			'credential_error' => 'خطأ فى الاسم أو الرقم السرى',
			'error_image' => 'الصورة غير صالحة',
			'error_continent' => 'القارة غير موجودة',
			'error_country' => 'المدينة غير موجودة',
			'error_user' => 'هذا العضو غير موجود',
			'error_place' => 'هذا المكان غير موجود',
			'error_place_type' => 'هذه الفئة غير موجودة',
			'error_place_exist' => 'هذا المكان موجود بالفعل',
			'error_rate_value' => 'التقييم غير صحيح',
			'error_rate_exist' => 'تم التقييم من قبل',
			'error_post_content' => 'يجب إدخال المحتوى',
			'error_post_content_length' => 'المحتوى قصير جدا',
		];
		return $messages[$code];
	}

	public static function sendSMS($message,$phone)
	{
        if(substr( $phone, 0, 5 ) === '00966')
            $phone = str_replace('00966', '966',  $phone);
        if(substr( $phone, 0, 5 ) === '+9660')
            $phone = str_replace('+9660', '966',  $phone);
        if(substr( $phone, 0, 4 ) === '5')
            $phone = '966'.$phone;

        $client = new \GuzzleHttp\Client();
        $username = USERNAME;
        $password = PASSWORD;
        $sender = SENDER;

        $sendUrl = "http://ultramsg.com/api.php?send_sms&username=".$username."&password=".$password."&numbers=".$phone."&sender=".$sender."&message=".$message."";
        $res = $client->request('GET', $sendUrl);
        
        if($res)
            return true;

        return false;
	}
}
