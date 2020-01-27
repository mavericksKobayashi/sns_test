<?php

namespace App\Http\Controllers;

use App\Person;
use App\Follow;
use Hash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{


	public function index(Request $request)
	{
		//Auth::logout();

		if (Auth::check()) {
			// ログイン済みのユーザーは自動転送
			return redirect()->intended('/home');
		} else {
			return view('user.register');
		}
	}


	public function postRegister(Request $request)
	{
		if (Auth::check()) {
			// ログイン済みのユーザーは自動転送
			return redirect()->intended('/home');
		} else {

			$this->validate($request, [
				'email'  => 'required|email|max:100',
				'password' => 'required|regex:/^[a-zA-Z0-9]+$/|max:100',
			],[
				'email.required' => 'メールアドレスをご入力ください。',
				'email.email' => '正しいメールアドレスをご入力ください。',
				'email.max' => 'メールアドレスが長すぎます。',
				'password.required' => 'パスワードをご入力ください。',
				'password.regex' => 'パスワードは半角英数字でご入力ください。',
				'password.max' => 'パスワードが長すぎます。',
			]);


			$email = $request->email;
			$password = $request->password;
			$nickname = $request->nickname;
			$place = $request->place;
			$gender = $request->gender;

			//パスワードをHash
      $encrypted = Hash::make($password);

			$user_records = Person::where('email', $email)->get();
			if(!$user_records->isEmpty()){
				$request->session()->flash('mail_error');
				return redirect('/register/create');
			}


			// マイクロ秒単位の現在時刻からユニークな文字列を生成
			$unique_test = true;
			$flip_id = '';
			function unique_id($l = 8) {
  	  	return substr(md5(uniqid(mt_rand(), true)), 0, $l);
			}
			$user_records = Person::where('flip_id', $flip_id)->get();
			while($unique_test){
				$flip_id = unique_id(10);
				if($user_records->isEmpty()){
					$unique_test = false;
				}
			}


			$param = [
				'flip_id' => $flip_id,
				'nickname' => $nickname,
				'email' => $email,
				'password' => $encrypted,
				'place' => $place,
				'gender' => $gender,
				'last_login' => time(),
				'created_at' => time(),
			];

			DB::table('users')->insert($param);


			if(Auth::attempt(['email' => $email,'password' => $password])){
				return redirect('/register/follow');
			}

			$msg = '登録できません。もう一度お試しください。';
			return view('/register/create',['message' => $msg]);

		}

	}


	// フォロー一覧
	public function follow(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;
		$view_id = $user_id;
		$myself = true;

		// アップデート降順、id降順、自分自信を除く、最大10件
		$users = Person::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('id', '!=', $user_id)
		->whereNotIn('freeze', [1])
		->limit(10)
		->get();

		// フォローリスト（フォロー判定用）
		$my_follows =  Person::find($view_id)
		->follows()
		->get();



		$param = [
			'user' => $user,
			'page' => 'register_follow',
			'myself' => $myself,
			'view_id' => $view_id,
			'users' => $users,
			'my_follows' => $my_follows,
		];

		return view('user.follow',$param);
	}


	// フォローPOST
	public function postFollow(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}


		if($request->do_follow == 'follow'){

			// フォロー：insert

			$param = [
				'user_id' => $user->id,
				'follow_id' => $request->nm_follow,
				'muted' => 0,
				'created_at' => time(),
    		'updated_at' => time(),
			];

			DB::table('follow')->insert($param);

		} else {

			// フォロー解除：delete

			DB::table('follow')
			->where('user_id', $user->id)
			->where('follow_id', $request->nm_follow)
			->delete();

		}

		return redirect('/register/follow');
	}


}
