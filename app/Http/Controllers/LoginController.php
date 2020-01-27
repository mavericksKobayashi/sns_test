<?php

namespace App\Http\Controllers;

use App\Person;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{


	public function index(Request $request)
	{
		//Auth::logout();

		if (Auth::check()) {
			// ログイン済みのユーザーは自動転送
			return redirect()->intended('/home');
		} else {
			return view('user.login');
		}
	}


	public function postAuth(Request $request)
	{
		if (Auth::check()) {
			// ログイン済みのユーザーは自動転送
			return redirect()->intended('/home');
		} else {

			$email = $request->email;
			$password = $request->password;

			$this->validate($request, [
				'email'  => 'required|email|max:100',
				'password' => 'nullable|regex:/^[a-zA-Z0-9]+$/|max:100',
			],[
				'email.required' => 'メールアドレスをご入力ください。',
				'email.email' => '正しいメールアドレスをご入力ください。',
				'email.max' => 'メールアドレスが長すぎます。',
				'password.required' => 'パスワードをご入力ください。',
				'password.regex' => 'パスワードは半角英数字でご入力ください。',
				'password.max' => 'パスワードが長すぎます。',
			]);


			$user_records = Person::where('email', $email)->get();

			foreach ($user_records as $user_record) {

				if(Auth::attempt(['email' => $email,'password' => $password])){

					// 認証成功
					$users_param = [
						'last_login' => time(),
					];
					DB::table('users')->where('email', $email)->update($users_param);
					return redirect()->intended('home')->with('flash_message', 'ログインしました');


					break;
				}

			}


			$msg = 'ログインできません。入力内容をご確認ください。';

			// PWハッシュ生成用
			//$msg = \Hash::make($password);

			return view('user.login',['message' => $msg]);


		}

	}
}
