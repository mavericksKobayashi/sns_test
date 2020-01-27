<?php

namespace App\Http\Controllers;

use finfo;
use Storage;
use File;
use Carbon\Carbon;

use App\Person;
use App\Imageprof;
use App\Post;
use App\Imagepost;
use App\Follow;
use App\Bookmark;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


	// ログイン後のユーザーホーム
	public function home(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;

		// フォローリスト（フォロー判定用）
		$my_follows =  Person::find($user_id)
		->follows()
		->get();

		$my_follow_arr = [];
		foreach ($my_follows as $my_follow) {
			array_push($my_follow_arr,$my_follow->follow_id);
		}

		// フォロワーのポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->whereIn('user_id', $my_follow_arr)
		->get();

		if($request->session()->get('applocale') == 'en'){
			$tab = 'Followers';
		} else {
			$tab = 'フォロワー';
		}

		$param = [
			'user' => $user,
			'posts' => $posts,
			'tab' => $tab,
		];

		return view('home',$param);
	}

	// ログイン後のユーザーホーム - おすすめ
	public function recommend(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// レート4以上のポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('rating', '>', 3)
		->where('publish', '>', 0)
		->take(96)
		->get();

		if($request->session()->get('applocale') == 'en'){
			$tab = 'Recommended';
		} else {
			$tab = 'おすすめ';
		}

		$param = [
			'user' => $user,
			'posts' => $posts,
			'tab' => $tab,
		];

		return view('home',$param);
	}

	// ログイン後のユーザーホーム - ピックアップ
	public function pickup(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// ピックアップポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('pickup', '>', 0)
		->where('publish', '>', 0)
		->take(96)
		->get();

		if($request->session()->get('applocale') == 'en'){
			$tab = 'Pick up';
		} else {
			$tab = 'ピックアップ';
		}

		$param = [
			'user' => $user,
			'posts' => $posts,
			'tab' => $tab,
		];

		return view('home',$param);
	}

	// ログイン後のユーザーホーム - 人気
	public function popular(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// カウント降順ポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('like','desc')
		->orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('publish', '>', 0)
		->take(96)
		->get();

		if($request->session()->get('applocale') == 'en'){
			$tab = 'Popularity';
		} else {
			$tab = '人気';
		}

		$param = [
			'user' => $user,
			'posts' => $posts,
			'tab' => $tab,
		];

		return view('home',$param);
	}

	// ログイン後のユーザーホーム - 新着
	public function arrival(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// ポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('publish', '>', 0)
		->take(96)
		->get();

		if($request->session()->get('applocale') == 'en'){
			$tab = 'New arrival';
		} else {
			$tab = '新着';
		}

		$param = [
			'user' => $user,
			'posts' => $posts,
			'tab' => $tab,
		];

		return view('home',$param);
	}



	// ユーザーページ
	public function index(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;
		$view_id = $request->user_id;
		$myself = false;
		if($user_id == $view_id){
			$myself = true;
		}


		if(Person::where('id', $view_id)->get()->isEmpty()){

			// 存在しないユーザーIDのURLはログインユーザーのページへ
			return redirect('/user/'.$user_id);

		} else {

			$view_user =  Person::where('id', $view_id)->first();

		}


		// 鍵アカ判定
		$locked_status =  Person::find($view_id)
		->locked;
		$locked = false;
		if($locked_status == 1){
			if(
				Follow::where('user_id', $user_id)
				->where('follow_id', $view_id)
				->exists()
			) {
				$locked = false;
			} else {
				$locked = true;
			}
		}


		if($myself){
			// ポスト 自分のもの アップデート降順、id降順
			$posts = Post::orderBy('updated_at','desc')
			->orderBy('id','desc')
			->where('user_id', $view_id)
			->get();
		} else {
			// ポスト 公開設定されているもの アップデート降順、id降順

			if($locked){
				// フォローしてない鍵アカ
				$posts = [];
			} else {
				// フォローしてる鍵アカ
				$posts = Post::orderBy('updated_at','desc')
				->orderBy('id','desc')
				->where('user_id', $view_id)
				->where('publish', '>', 0)
				->get();
			}
		}

		// フォローカウント
		$follows_count = Follow::where('user_id', $view_id)->count();

		// フォロワーカウント
		$followers_count = Follow::where('follow_id', $view_id)->count();

		// ブックマークカウント
		$bookmark_count = Bookmark::where('user_id', $view_id)->count();

		// フォローリスト（フォロー判定用）
		$my_follows =  Person::find($user_id)
		->follows()
		->get();

		$param = [
			'user' => $user,
			'user_id' => $user_id,
			'view_id' => $view_id,
			'myself' => $myself,
			'view_user' => $view_user,

			'posts' => $posts,

			'follows_count' => $follows_count,
			'followers_count' => $followers_count,
			'bookmark_count' => $bookmark_count,

			'my_follows' => $my_follows,

			// 鍵アカは「1」
			'locked_status' => $locked_status,
		];

		return view('user.index',$param);
	}


	// 自分ではないユーザーのマイページからポスト（フォロー or フォロー解除）
	public function postIndex(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;
		$view_id = $request->user_id;

		if($request->do_follow == 'unfollow'){

			// フォロー解除：delete

			DB::table('follow')
			->where('user_id', $user->id)
			->where('follow_id', $view_id)
			->delete();

		} else if($request->do_follow == 'follow'){

			// フォロー：insert

			$param = [
				'user_id' => $user->id,
				'follow_id' => $view_id,
				'muted' => 0,
				'created_at' => time(),
    		'updated_at' => time(),
			];

			DB::table('follow')->insert($param);

		}

		return redirect('/user/'.$view_id);
	}





	// ユーザー情報の編集画面
	public function edit(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}


		$param = ['user' => $user];

		return view('user.edit',$param);
	}



	// ユーザー情報のアップデート
	public function post(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;


    ////
    //// プロフィール画像追加
    ////

		if(!empty($request->file('image_prof'))){

      $validatedData = $request->validate([
        'image_prof' => [
          'required',	// 必須
          'file',	// アップロードされたファイルであること
          'image',	// 画像ファイルであること
          'mimes:jpeg',	// MIMEタイプを指定
          'max:10240',	// 10MBまで
        ]
      ]);

      if ($validatedData) {

      	// オリジナルファイルネーム
      	//$original_file_name = $request->file('image_prof')->getClientOriginalName();

				// 拡張子判定
				list($img_width, $img_height, $mime_type, $attr) = getimagesize($request->file('image_prof'));
				switch($mime_type){
			    case IMAGETYPE_JPEG:
		        $img_extension = "jpg";
    		    break;
			    case IMAGETYPE_PNG:
		        $img_extension = "png";
    		    break;
			    case IMAGETYPE_GIF:
		        $img_extension = "gif";
    		    break;
				}

				// タイムスタンプ型のファイルネーム
      	// $original_file_name = 'item_' . date('YmdHis') . '.' . $img_extension;
      	// $file_name = 'item_' . date('YmdHis') . '_thumb.' . $img_extension;

      	// 固定ファイルネーム
      	$original_file_name = 'user_profile' . '_original' . '.' . $img_extension;
      	$file_name = 'user_profile' . '.' . $img_extension;


      	// ファイルサイズ
      	$file_size = filesize($request->file('image_prof'));


      	// MIMEタイプ
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				$mime_type = $finfo->file($request->file('image_prof'));


					$image_param = [
						'user_id' => $user_id,
						'type' => $mime_type,
						'size' => $file_size,
						'mimetype' => $mime_type,
						'created_at' => time(),
    				'updated_at' => time(),
					];



				if(Imageprof::where('user_id', $user_id)->get()->isEmpty()){

					// DB書き込み
					DB::table('image_prof')->insert($image_param);

				} else {

					// DBアップデート
					DB::table('image_prof')->where('user_id', $user_id)->update($image_param);

				}


      	// アップロード：アップロード先ベースフォルダは config/filesystems.php で変更済み
      	$request->file('image_prof')->storeAs($user_id, $original_file_name);


      	// サムネイルのリサイズ
      	$req_file = $request->file('image_prof');
      	$req_file_path = public_path().'/uploads/'.$user_id.'/';
				$thumb_img = \Image::make($req_file)->fit(160, 160, function($constraint){
			    $constraint->upsize(); // 大きくなるのを防止
				});
				// 保存
				$thumb_img->save($req_file_path.$file_name);


      } else {

      	$request->session()->flash('image_error', '画像を登録できません。');

      }
		}



		$this->validate($request, [
			'email'  => 'required|email|max:100',
			'flip_id' => 'required|regex:/^[a-zA-Z0-9]+$/|max:30',
			'nickname'  => 'required|max:30',
			'place'  => 'nullable|max:30',
			'self_intro'  => 'nullable|max:200',
		],[
			'email.required' => 'メールアドレスが未入力でした。',
			'email.email' => '正しいメールアドレスをご入力ください。',
			'email.max' => 'メールアドレスが長すぎます。',
			'flip_id.required' => 'FLIP ID が未入力でした。',
			'flip_id.regex' => 'FLIP ID は半角英数字でご入力ください。',
			'flip_id.max' => 'FLIP ID が長すぎます。',
			'nickname.required' => 'ニックネームが未入力でした。',
			'nickname.max' => 'ニックネームが長すぎます。',
			'place.max' => '場所が長すぎます。',
			'self_intro.max' => '自己紹介は200文字以内です。',
		]);


		$email = $request->email;
		$flip_id = $request->flip_id;
		$nickname = $request->nickname;
		$place = $request->place;
		$gender = $request->gender;
		$self_intro = $request->self_intro;
		$locked = $request->locked;
		$block = $request->block;
		$db_email = $user->email;
		$db_flip_id = $user->flip_id;


		// メールアドレスが変更される場合は一意の文字列かチェックする
		if($email != $db_email){
			if(!Person::where('email', $db_email)->get()->isEmpty()){
				$request->session()->flash('mail_error', 'そのメールアドレスは使えません。');
				return redirect('/user_edit');
			}
		}


		// FLIP ID が変更される場合は一意の文字列かチェックする
		if($flip_id != $db_flip_id){
			if(!Person::where('flip_id', $db_flip_id)->get()->isEmpty()){
				$request->session()->flash('flip_error', 'そのFLIP IDは使えません。');
				return redirect('/user_edit');
			}
		}


		// 性別の未登録
		if($gender == '性別を選ぶ'){
			$gender = '';
		}


		$param = [
			'flip_id' => $flip_id,
			'nickname' => $nickname,
			'email' => $email,
			'password' => $user->password,
			'place' => $place,
			'gender' => $gender,
			'self_intro' => $self_intro,
			'locked' => $locked,
			'block' => $block,
			'updated_at' => time(),
		];

		DB::table('users')->where('id', $user_id)->update($param);


		$request->session()->flash('updated', '変更を保存しました。');

		return redirect('/user_edit');

	}





	//
	// フォロー　フォロワー
	//


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

		$view_id = $request->user_id;
		$myself = false;
		if($user_id == $view_id){
			$myself = true;
		}

		// アップデート降順、id降順
		$follows = Follow::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('user_id', $view_id)
		->get();

		// カウント
		$follows_count = $follows->count();

		// フォローリスト（フォロー判定用）
		$my_follows =  Person::find($user_id)
		->follows()
		->get();

		$param = [
			'user' => $user,
			'page' => 'follow',
			'myself' => $myself,
			'view_id' => $view_id,
			'follows' => $follows,
			'my_follows' => $my_follows,
		];

		return view('user.follow',$param);
	}


	// フォロー一覧からのポスト
	public function postFollow(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		if($request->do_follow == 'unfollow'){

			// フォロー解除：delete

			DB::table('follow')
			->where('user_id', $user->id)
			->where('follow_id', $request->nm_follow)
			->delete();

		} else if($request->do_follow == 'follow'){

			// フォロー：insert

			$param = [
				'user_id' => $user->id,
				'follow_id' => $request->nm_follow,
				'muted' => 0,
				'created_at' => time(),
    		'updated_at' => time(),
			];

			DB::table('follow')->insert($param);

		}

		if($user->id == $request->user_id) {
			return redirect('/user_follow/'.$user->id);
		} else {
			return redirect('/user_follow/'.$request->user_id);
		}
	}


	// フォロワー一覧
	public function follower(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		$view_id = $request->user_id;
		$myself = false;
		if($user_id == $view_id){
			$myself = true;
		}

		// アップデート降順、id降順
		$followers = Follow::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('follow_id', $view_id)
		->get();

		// カウント
		$followers_count = $followers->count();

		// フォローリスト（フォロー判定用）
		$my_follows =  Person::find($user_id)
		->follows()
		->get();

		$param = [
			'user' => $user,
			'page' => 'follower',
			'myself' => $myself,
			'view_id' => $view_id,
			'followers' => $followers,
			'my_follows' => $my_follows,
		];

		return view('user.follow',$param);
	}


	// フォロワー一覧からのポスト
	public function postFollower(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		if($request->do_follow == 'unfollow'){

			// フォロー解除：delete

			DB::table('follow')
			->where('user_id', $user->id)
			->where('follow_id', $request->nm_follow)
			->delete();

		} else if($request->do_follow == 'follow'){

			// フォロー：insert

			$param = [
				'user_id' => $user->id,
				'follow_id' => $request->nm_follow,
				'muted' => 0,
				'created_at' => time(),
    		'updated_at' => time(),
			];

			DB::table('follow')->insert($param);

		}

		if($user->id == $request->user_id) {
			return redirect('/user_follower/'.$user->id);
		} else {
			return redirect('/user_follower/'.$request->user_id);
		}
	}






/*


	// ユーザー一覧
	public function list(Request $request)
	{
		$authority = Auth::user()->authority;

		if (Auth::check()) {

			$return = 'user';
			if($authority == 'admin'){
				$return = 'admin';
			} else if($authority == 'agency') {
				$return = 'agency';
			}

			// ★ユーザーは進入禁止
			if($authority == 'user') {
				return redirect('/config/user');
			}

			// フィード
			$auth_id = Auth::user()->id;
			$profs = Userprofiles::where('user_id', $auth_id)->first();
			$agency_id = $profs->agency_id;

			$feed_sort = 'id';
			if($authority == 'agency') {
				$feeds = Userprofiles::orderBy($feed_sort,'asc')->where('agency_id',$agency_id)
				->where('user_id', '!=', $agency_id)->orWhereNull('user_id')->get();
				// orWhereNull：nullが入っていると!=で抽出されないため
			} else {
				$feeds = Userprofiles::orderBy($feed_sort,'asc')->get();
			}


    	#キーワード
  		$keyword = $request->input('keyword');

  		#フィルター
  		$filter = $request->input('filter');


    	// 再取得
    	if($authority == 'agency') {

    		if(empty($keyword)){
	    		// 自分自身は除く
	    		$feeds = Userprofiles::orderBy($feed_sort,'asc')
	    		->where('agency_id',$agency_id)
					->where('user_id', '!=', $agency_id)->paginate(50);
				} else {
	    		$feeds = Userprofiles::orderBy($feed_sort,'asc')
	    		->where('agency_id',$agency_id)
					->where(function ($query) use ($keyword,$auth_id) {
  	        return $query->where('name','like','%'.$keyword.'%')
  	        ->orWhere('p_name','like','%'.$keyword.'%')
						->orWhere('address','like','%'.$keyword.'%')
						->orWhere('user_id','like','%'.$keyword.'%')
						->whereColumn('user_id', '!=', 'agency_id')
						->where('user_id', '!=', $auth_id);
    	    })
					->paginate(50);
				}

			} else {

				if(empty($keyword)){

					if(empty($filter)||$filter=='default'){
						// 代理店は別管理のため除く（user_id と agency_idが一致）、自分自身は除く
						$feeds = Userprofiles::orderBy($feed_sort,'asc')
						->whereColumn('user_id', '!=', 'agency_id')
						->where('user_id', '!=', $auth_id)
						->paginate(100);
 					} else {
						$feeds = Userprofiles::orderBy($feed_sort,'asc')
						->where('agency_id', $filter)
						->whereColumn('user_id', '!=', 'agency_id')
						->paginate(50);
					}

				} else {

					if(empty($filter)||$filter=='default'){

						// 代理店は別管理のため除く（user_id と agency_idが一致）、自分自身は除く
						$feeds = Userprofiles::orderBy($feed_sort,'asc')
						->whereColumn('user_id', '!=', 'agency_id')
						->where('name','like','%'.$keyword.'%')
						->orWhere('p_name','like','%'.$keyword.'%')
						->orWhere('address','like','%'.$keyword.'%')
						->orWhere('user_id','like','%'.$keyword.'%')
						->where('user_id', '!=', $auth_id)
						->paginate(100);
					} else {
						$feeds = Userprofiles::orderBy($feed_sort,'asc')
						->whereColumn('user_id', '!=', 'agency_id')
						->where('agency_id', $filter)
						->where(function ($query) use ($keyword,$auth_id) {
  	        	return $query->where('name','like','%'.$keyword.'%')
  	        	->orWhere('p_name','like','%'.$keyword.'%')
							->orWhere('address','like','%'.$keyword.'%')
							->orWhere('user_id','like','%'.$keyword.'%')
							->where('user_id', '!=', $auth_id);
    	      })
						->paginate(100);
					}

				}
			}


			$profiles = Userprofiles::get();


			// フィルター用
			$agency_names=array();
			if($authority == 'admin') {
				foreach ($profiles as $profile) {
					$name_arr[]=$profile->agency_id;
				}
				$hit_arr = array_unique($name_arr);
				$hit_num = array_diff($hit_arr, array('0'));
				$agency_names = Userprofiles::orderBy('id','asc')
				->whereIn('user_id', $hit_num)
				->where('name', '!=', '')
				->get();
			}


			// 契約数用
			$hit_arr=array();
			foreach ($feeds as $feed) {
				$hit_arr[]=$feed->user_id;
			}
			$agreements = Agreements::whereIn('user_id', $hit_arr)->get();


			$param = [
				'authority' => $authority,
				'return' => $return,
				'feeds' => $feeds,
				'profiles' => $profiles,
				'agreements' => $agreements,
				'agency_names' => $agency_names,
			];

			return view('user.list', $param)
			->with('keyword',$keyword);

		} else {
			// ログインしていないユーザーは自動転送
			return redirect()->intended('user/login');
		}
	}



	// 代理店一覧
	public function agency_list(Request $request)
	{
		$authority = Auth::user()->authority;

		if (Auth::check()) {

			$return = 'admin';

			// ★ユーザー、代理店は進入禁止
			if($authority == 'user') {
				return redirect('/user/dashboard');
			} else if($authority == 'agency') {
				return redirect('/agency/dashboard');
			}

			$auth_id = Auth::user()->id;

			$users = Person::where('authority', 'agency')->get();
			foreach ($users as $user) {
				$user_arr[]=$user->id;
			}

			$feed_sort = 'user_id';
			$feeds = Userprofiles::orderBy($feed_sort,'asc')->whereIn('user_id', $user_arr)
			->where('user_id', '!=', $auth_id)->orWhereNull('user_id')->paginate(30);
			// orWhereNull：nullが入っていると!=で抽出されないため


			foreach ($feeds as $feed){
				$my_id = $feed->agency_id;

				// 契約ユーザー数
				$user_num = Userprofiles::orderBy($feed_sort,'asc')->where('agency_id', $my_id)->count();
				$user_num_arr[]=$user_num-1;//自分を除く

				// 今月の料金
				$user_csts = Userprofiles::orderBy($feed_sort,'asc')->where('agency_id', $my_id)
				->where('user_id', '!=', $auth_id)->orWhereNull('user_id')->get();
				$user_csts_price = 0;
				foreach ($user_csts as $user_cst){
					// 自分を除く
					if(Person::where('id', $user_cst->user_id)->first()){
						$my_auth = Person::where('id', $user_cst->user_id)->first()->authority;
						if($my_auth != 'agency'){
							$user_csts_price += $user_cst->cost;
						}
					}
				}
				$user_cst_arr[]=$user_csts_price;
			}
			//echo $user_cst_arr[2];exit();


			// 料金
			$profiles = Userprofiles::get();
			$agreements = Agreements::get();


			$param = [
				'authority' => $authority,
				'return' => $return,
				'feeds' => $feeds,
				'profiles' => $profiles,
				'agreements' => $agreements,
				'user_num_arr' => $user_num_arr,
				'user_cst_arr' => $user_cst_arr,
			];

			return view('agency.list', $param);

		} else {
			// ログインしていないユーザーは自動転送
			return redirect()->intended('user/login');
		}
	}

	*/

}
