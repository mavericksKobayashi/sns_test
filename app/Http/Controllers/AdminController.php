<?php

namespace App\Http\Controllers;

use finfo;
use Storage;
use File;
use Carbon\Carbon;

use App\Post;
use App\Category;
use App\Person;
use App\Follow;
use App\Like;
use App\Bookmark;
use App\Comment;
use App\Imagepost;
use App\Imageprof;
use App\News;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

	//トップ一覧
	public function index(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		$user_lists = Person::orderBy('created_at', 'desc')
		->take(50)
		->get();

		$user_datas = array();
		$user_num = 1;
		foreach ($user_lists as $user_list) {

			$follows_count = Follow::where('user_id', $user_list->id)->count();

			$followers_count = Follow::where('follow_id', $user_list->id)->count();

			$like_count = Like::where('post_id', $user_list->id)->count();

			$post_count = Post::where('user_id', $user_list->id)->count();

			$created_at = $user_list->created_at->format('Y-m-d');

			$val_arr = array($user_list->id,$user_list->nickname,$follows_count,$followers_count,$like_count,$post_count,$created_at,$user_num);
			//[0]id
			//[1]ニックネーム
			//[2]フォロー数
			//[3]フォロワー数
			//[4]いいね数
			//[5]ポストの数
			//[6]登録日
			//[7]上から番号

			array_push($user_datas,$val_arr);

			$user_num++;
			if($user_num>50){
				break;
			}
		}

		// print_r($user_datas);//検証
		// echo $user_datas[2][1];

		//今日の投稿数取得
		$time = new Carbon(Carbon::today());
		$to_day = $time->timestamp;
		$to_day_posts = Post::orderBy('created_at', 'desc')
		->where('created_at','>=', $to_day)
		->count();

		//昨日の投稿数取得
		$yesterday_date = $time->subDay();
		$yesterday = $yesterday_date->timestamp;
		$yesterday_posts = Post::orderBy('created_at', 'desc')
		->where('created_at','<', $to_day)
		->where('created_at','>=', $yesterday)
		->count();

		//一昨日の投稿数取得
		$day_before_date = $yesterday_date->subDay();
		$day_before = $day_before_date->timestamp;
		$day_before_posts = Post::orderBy('created_at', 'desc')
		->where('created_at','<', $yesterday)
		->where('created_at','>=', $day_before)
		->count();

		//会員数
		$members = Person::orderBy('created_at', 'desc')
		->count();

		//今月会員になった数
		$month_date = Carbon::now()->startOfMonth();
		$current_month = $month_date->timestamp;
		$current_month_members = Person::where('created_at','>=', $current_month)
		->count();

		//先月会員になった数
		$last_month_date = $month_date->subMonth();
		$last_month = $last_month_date->timestamp;
		$last_month_members = Person::where('created_at','>=', $last_month)
		->where('created_at', '<', $current_month)
		->count();

		$param = [
			'user_id' => $user_id,
			'user_datas' => $user_datas,
			'to_day_posts' => $to_day_posts,
			'yesterday_posts' => $yesterday_posts,
			'day_before_posts' => $day_before_posts,
			'members' => $members,
			'current_month_members' => $current_month_members,
			'last_month_members' => $last_month_members,
		];

		return view('admin.index',$param);

	}

	//ユーザー一覧
	public function user(Request $request)
	{

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		$keyword = $request->input('keyword');

		if(!empty($keyword))
		{
			$user_lists = Person::orderBy('created_at', 'desc')
			->where('id','like','%'.$keyword.'%')
			->orWhere('flip_id','like','%'.$keyword.'%')
			->orWhere('nickname','like','%'.$keyword.'%')
			->orWhere('email','like','%'.$keyword.'%')
			->orWhere('place','like','%'.$keyword.'%')
			->orWhere('gender','like','%'.$keyword.'%')
			->orWhere('self_intro','like','%'.$keyword.'%')
			->paginate(0);
		} else {
			$user_lists = Person::orderBy('created_at', 'desc')
			->take(50)
			->get();
		}


		$user_datas = array();
		$user_num = 1;
		foreach ($user_lists as $user_list) {

			$follows_count = Follow::where('user_id', $user_list->id)->count();

			$followers_count = Follow::where('follow_id', $user_list->id)->count();

			$like_count = Like::where('post_id', $user_list->id)->count();

			$post_count = Post::where('user_id', $user_list->id)->count();

			$created_at = $user_list->created_at->format('Y-m-d');

			$val_arr = array($user_list->id,$user_list->nickname,$follows_count,$followers_count,$like_count,$post_count,$created_at,$user_num,$user_list->flip_id);

			//[0]id
			//[1]ニックネーム
			//[2]フォロー数
			//[3]フォロワー数
			//[4]いいね数
			//[5]ポストの数
			//[6]登録日
			//[7]上から番号
			//[8]ユーザーID

			array_push($user_datas,$val_arr);

			$user_num++;
			if($user_num>50){
				break;
			}
		}


		$param = [
			'user_id' => $user_id,
			'user_datas' => $user_datas,
		];

		return view('admin.user',$param);

	}

	//ポスト一覧
	public function post(Request $request)
	{

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		$keyword = $request->input('keyword');

		if(!empty($keyword))
		{
			$post_lists = Post::orderBy('created_at', 'desc')
			->where('id','like','%'.$keyword.'%')
			->orWhere('user_id','like','%'.$keyword.'%')
			->orWhere('place','like','%'.$keyword.'%')
			->orWhere('contents','like','%'.$keyword.'%')
			->orWherehas('post_category', function ($query) use ($keyword) {
				$query->where('name','like','%'.$keyword.'%');
			})
			->orWherehas('post_tag', function ($query) use ($keyword) {
				$query->where('name','like','%'.$keyword.'%');
			})
			->paginate(0);
		} else {
			$post_lists = Post::orderBy('created_at', 'desc')
			->take(50)
			->get();
		}


		$post_datas = array();
		$user_num = 1;
		foreach ($post_lists as $post_list) {

			$post_id = $post_list->id;
			$post_cat = $post_list->category;
			$post_time = $post_list->created_at->format('Y-m-d');
			$post_user_id = $post_list->user_id;
			$post_freeze = $post_list->freeze;

			$bookmark = Bookmark::where('post_id', $post_id)
			->count();

			$like = Like::where('post_id', $post_id)
			->count();

			$comment = Comment::where('post_id', $post_id)
			->count();

			if($post_images = Imagepost::where('post_id',$post_id)
				->first()){
				$post_image_type = $post_images->type;
				$order_num = $post_images->order_num;
			} else {
				$post_image_type = '';
				$order_num = '';
			}


			if($user_id = Person::find($post_user_id)){
				$user_flip_id = $user_id->flip_id;
			} else {
				$user_flip_id = '';
			}

			if($category = Category::find($post_cat)){
				$category = $category->name;
			} else {
				$category = '';
			}

			$val_arr = array(
				$user_flip_id,//0 flip_id
				$post_user_id,//1 ユーザーID
				$post_id,//2 ポストID
				$post_images,//3 イメージの有無
				$post_image_type,//4 イメージのタイプ
				$order_num,//5 イメージナンバー
				$bookmark,//6 ブックマークの数
				$like,//7 ライクの数
				$comment,//8 コメントの数
				$category,//9 カテゴリー
				$post_time,//10 投稿時間
				$post_freeze,//11 凍結
				$user_num);//


			array_push($post_datas,$val_arr);

			$user_num++;
			if($user_num>50){
				break;
			}
		}


		$param = [
			'user_id' => $user_id,
			'post_datas' => $post_datas,
			'keyword' => $keyword,
		];

		return view('admin.post',$param);

	}

	//ポスト凍結
	public function post_freeze(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}
		if($request->freeze == 1){
			$publish = 0;
		} else {
			$publish = 1;
		}

		$param = [
			'id' => $request->post_id,
			'freeze' => $request->freeze,
			'publish' => $publish,
		];

		DB::table('post')->where('id', $request->post_id)->update($param);

		return back();
	}

	//ユーザーの編集画面
	public function user_edit(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		$edit_user_id = $request->edit_user_id;

		$edit_user = Person::where('id',$edit_user_id)
		->first();

		$param = [
			'user_id' => $user_id,
			'edit_user_id' => $edit_user_id,
			'edit_user' => $edit_user,
		];

		return view('admin.user_edit',$param);
	}

	//ユーザーの編集DB格納
	public function user_edit_post(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		$edit_user_id = $request->edit_user_id;

		$edit_user = Person::where('id',$edit_user_id)
		->first();

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
						'user_id' => $edit_user_id,
						'type' => $mime_type,
						'size' => $file_size,
						'mimetype' => $mime_type,
						'created_at' => time(),
    				'updated_at' => time(),
					];



				if(Imageprof::where('user_id', $edit_user_id)->get()->isEmpty()){

					// DB書き込み
					DB::table('image_prof')->insert($image_param);

				} else {

					// DBアップデート
					DB::table('image_prof')->where('user_id', $edit_user_id)->update($image_param);

				}


      	// アップロード：アップロード先ベースフォルダは config/filesystems.php で変更済み
      	$request->file('image_prof')->storeAs($edit_user_id, $original_file_name);


      	// サムネイルのリサイズ
      	$req_file = $request->file('image_prof');
      	$req_file_path = public_path().'/uploads/'.$edit_user_id.'/';
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
		$freeze = $request->freeze;
		$db_email = $edit_user->email;
		$db_flip_id = $edit_user->flip_id;


		// メールアドレスが変更される場合は一意の文字列かチェックする
		if($email != $db_email){
			if(!Person::where('email', $db_email)->get()->isEmpty()){
				$request->session()->flash('mail_error', 'そのメールアドレスは使えません。');
				return back();
			}
		}


		// FLIP ID が変更される場合は一意の文字列かチェックする
		if($flip_id != $db_flip_id){
			if(!Person::where('flip_id', $db_flip_id)->get()->isEmpty()){
				$request->session()->flash('flip_error', 'そのFLIP IDは使えません。');
				return back();
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
			'freeze' => $freeze,
			'updated_at' => time(),
		];

		DB::table('users')->where('id', $edit_user_id)->update($param);


		$request->session()->flash('updated', '変更を保存しました。');

		return back();
	}

	//お知らせ一覧
	public function news(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		//お知らせ一覧　公開日順
		$news_lists = News::orderBy('release_date', 'desc')
		->get();

		$param = [
			'news_lists' => $news_lists,
		];

		return view('admin.news',$param);

	}

	//お知らせ作成
	public function news_create(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		//お知らせ一覧　公開日順

		$param = [
		];

		return view('admin.news_create',$param);

	}

	//お知らせ作成　DB格納
	public function news_create_post(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}


		$writer = $request->writer;
		$title = $request->title;
		$contents = $request->contents;
		$publish = $request->publish;
		$release_date = $request->release_date;


		$param = [
			'writer' => $writer,
			'title' => $title,
			'contents' => $contents,
			'publish' => $publish,
			'release_date' => $release_date,
			'created_at' => time(),
			'updated_at' => time(),
		];

		DB::table('news')->insert($param);

		return redirect('/admin/news');

	}

	//お知らせ編集　DB格納
	public function news_edit(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		//お知らせ一覧　公開日順
		$news_id = $request->news_id;

		$news = News::where('id',$news_id)
		->first();


		$param = [
			'news_id' => $news_id,
			'news_writer' => $news->writer,
			'news_title' => $news->title,
			'news_contents' => $news->contents,
			'news_publish' => $news->publish,
			'release_date' => $news->release_date,
			'created_at' => $news->created_at,
			'updated_at' => $news->updated_at,
		];

		return view('admin.news_edit',$param);

	}

	public function news_edit_post(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if($user_id == 1){
		} else {
			return redirect()->intended('/');
		}

		$news_id = $request->news_id;

		$writer = $request->writer;
		$title = $request->title;
		$contents = $request->kuchikomi;
		$publish = $request->publish;
		$release_date = $request->release_date;


		$param = [
			'writer' => $request->writer,
			'title' => $request->title,
			'contents' => $request->contents,
			'publish' => $request->publish,
			'release_date' => $request->release_date,
			'updated_at' => time(),
		];

		DB::table('news')->where('id', $news_id)->update($param);

		return back();

	}

}
