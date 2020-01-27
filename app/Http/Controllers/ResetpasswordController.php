<?php

namespace App\Http\Controllers;

use App\Person;
use App\Userprofiles;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Mail\Reset;


class ResetpasswordController extends Controller
{


	public function index(Request $request)
	{
		//Auth::logout();

		// ログイン済みのユーザーはホームへ自動転送
		if (Auth::check()) {
			return redirect()->intended('/home');
		} else {
			return view('user.resetpassword');
		}
	}


	public function reset(Request $request)
	{

		if( $users = Person::where('email', $request->email)->first() ){

			$user_id = $users->id;
			$user_name = $users->nickname;

    	\Mail::to('onizuka@mavericks09.com')->send(new Reset($users,$user_id,$user_name));

    	$msg = '・パスワード再発行の申請中です。';

			return view('user.login',['message' => $msg]);

		} else {

			$msg = '・メールアドレスが登録されていません。';

			return view('user.resetpassword',['message' => $msg]);
		}

	}

}

