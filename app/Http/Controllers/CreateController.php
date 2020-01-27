<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\Imagepost;

use finfo;
use Storage;
use File;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{


	public function index(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/login');
		}
		$user_id = $user->id;


		// カテゴリー
		$categories = Category::all();

		// 凍結中
		$post_freeze = '';

		//言語
		if($request->session()->get('applocale') == 'en'){
    	$lang = 'en';
  	} else {
    	$lang = 'jp';
  	}


		$param = [
			'mode' => 'create',
			'user' => $user,
			'categories' => $categories,
			'my_category' => '',
			'post_freeze' => $post_freeze,
			'lang' => $lang,
		];

		return view('create',$param);
	}




	public function edit(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		$post_id = $request->post_id;

		// データベース
		if($post = Post::where('id', $post_id)->first()){
		} else {
			return redirect()->intended('/home');
		}

		// 自分の管理ポストじゃない
		if($post->user_id != $user_id){
			return redirect()->intended('/home');
		}


		// メイン画像
		$my_mains = Imagepost::where('post_id', $post_id)->get();
		$my_mains_count = $my_mains->count();
		$my_mains_remain = 10 - $my_mains_count;


		// 場所
		$my_place = $post->place;


		// マップ
		$my_map = explode(',',$post->map);
		$my_lat = $my_map[0];
		$my_lng = $my_map[1];


		// コンテンツ
		$my_contents = $post->contents;


		// タグ
		$my_tags = Tag::where('post_id', $post_id)->get();


		// カテゴリー
		$categories = Category::all();

		if($category = Category::find($post->category)){
			$my_category = $category->name;
		} else {
			$my_category = '';
		}


		// 訪問日
		$my_date = $post->date;
		if(date('Y', $my_date)>1970){
			$my_date = date('Y.n.j', $my_date);
		} else {
			$my_date = '';
		}


		// 評価
		$my_rate = $post->rating;


		// 公開設定
		$my_pub = $post->publish;

		// 凍結中
		$post_freeze = $post->freeze;

		//言語
		if($request->session()->get('applocale') == 'en'){
    	$lang = 'en';
  	} else {
    	$lang = 'jp';
  	}


		$param = [
			'mode' => 'edit',
			'user' => $user,
			'user_id' => $user_id,
			'my_mains' => $my_mains,
			'my_mains_remain' => $my_mains_remain,
			'my_place' => $my_place,
			'my_lat' => $my_lat,
			'my_lng' => $my_lng,
			'my_contents' => $my_contents,
			'categories' => $categories,
			'my_category' => $my_category,
			'my_tags' => $my_tags,
			'my_date' => $my_date,
			'my_rate' => $my_rate,
			'my_pub' => $my_pub,
			'post_freeze' => $post_freeze,
			'post_id' => $post_id,
			'lang' => $lang,
		];

		return view('create',$param);
	}




	public function post(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;


		$this->validate($request, [
			'place'  => 'required|max:300',
			'kuchikomi' => 'nullable|max:1200',
		],[
			'place.required' => '場所が設定されていません。',
			'place.max' => '場所の名前が長すぎます。',
			'kuchikomi.max' => 'クチコミは1200文字までです。',
		]);


		// 公開設定
		$publish = 0;
		if($request->public == 'on'){
			$publish = 1;
		}

		// 訪問日
		if($request->date){
			$date_arr = explode('.',$request->date);
			$date = Carbon::create($date_arr[0], $date_arr[1], $date_arr[2], 0, 0, 0)->timestamp;
		} else {
			$date = time();
		}

		// 緯度経度
		$latLng = $request->lat.','.$request->lng;

		// カテゴリー
		if($request->category != ''){
			$category_num = $request->category;
		} else {
			$category_num = 0;
		}


		// パラメータ
		$param = [
			'user_id' => $user->id,
			'place' => $request->place,
			'map' => $latLng,
			'contents' => $request->kuchikomi,
			'category' => $category_num,

			'date' => $date,
			'rating' => $request->rate,
			'pickup' => 0,
			'like' => 0,
			'publish' => $publish,
			'created_at' => time(),
  		'updated_at' => time(),
		];


		if($request->mode == 'create'){
			DB::table('post')->insert($param);

			// いま投稿したポストID
			$post_ids = Post::orderBy('id','desc')
			->get(['id'])->first();
			$post_id = $post_ids->id;

		} else {
			$post_id = $request->post_id;

			DB::table('post')->where('id', $post_id)->update($param);
		}



		// タグ登録
		if($request->mode == 'edit'){
			// 一旦削除
			DB::table('tag')->where('post_id', $post_id)->delete();
		}
		$tags = $request->tags;
		if(isset($tags)){
			foreach ($tags as $key => $value) {
				$tag_param = [
					'post_id' => $post_id,
					'name' => $value,
					'created_at' => time(),
	  			'updated_at' => time(),
				];
				DB::table('tag')->insert($tag_param);
			}
		}



		// メイン画像
		if($files = $request->file('file')){

			$file_validation = true;

			foreach($files as $file){

				// 拡張子判定
				list($img_width, $img_height, $mime_type, $attr) = getimagesize($file);
				switch($mime_type){
			    case IMAGETYPE_JPEG:
		        $img_extension = 'jpg';
	  		    break;
			    case IMAGETYPE_PNG:
		        $img_extension = 'png';
	  		    break;
	  		  default:
	  		  $img_extension = 'badType';
				}
				if($img_extension == 'badType'){
					$file_validation = false;
					break;
				}

				// ファイルサイズ
	    	$file_size = filesize($file);
	    	if($file_size > 10240000){
					$file_validation = false;
					break;
				}

			}


			// 自前バリデーションエラー
			if(!$file_validation){

				if($request->mode == 'create'){

					// データベース削除
					Post::where('id', $post_id)->delete();

					// データベース削除
					Tag::where('post_id', $post_id)->delete();

					// リダイレクト
					return redirect('/create');

				} else {

					// リダイレクト
					return redirect('/edit/'.$post_id);

				}


			} else {


				// order_num 現在の最大値
				if($order_one = Imagepost::orderBy('order_num','desc')
				->where('post_id', $post_id)
				->first()){
					$order_num = $order_one->order_num;
				} else {
					$order_num = 0;
				}


				foreach($files as $file){

					$order_num ++;

					// 拡張子判定
					list($img_width, $img_height, $mime_type, $attr) = getimagesize($file);
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

		    	// ファイルサイズ
		    	$file_size = filesize($file);

		    	// MIMEタイプ
					$finfo = new finfo(FILEINFO_MIME_TYPE);
					$mime_type = $finfo->file($file);


					// オリジナルファイルネーム
		    	//$file_name = $file->getClientOriginalName();

					// タイムスタンプ型のファイルネーム
		    	//$file_name = 'item_' . date('YmdHis') . '.' . $img_extension;

					// order_numベースのファイルネーム
		    	$file_name = 'post_' . $post_id . '_' . $order_num . '.' . $img_extension;
		    	$file_name_thumb = 'post_' . $post_id . '_' . $order_num . '_thumb.' . $img_extension;

					$image_param = [
						'post_id' => $post_id,
						'order_num' => $order_num,
						'type' => $mime_type,
						'size' => $file_size,
						'mimetype' => $mime_type,
						'created_at' => time(),
						'updated_at' => time(),
					];

					// DB書き込み
					DB::table('image_post')->insert($image_param);


		    	// アップロード：アップロード先ベースフォルダは config/filesystems.php で変更済み
		    	$file->storeAs($user_id, $file_name);


		    	// サムネイルのリサイズ
		    	$file_path = public_path().'/uploads/'.$user_id.'/';
					$thumb_img = \Image::make($file)->fit(480, 480, function($constraint){
				    $constraint->upsize(); // 大きくなるのを防止
					});
					// 保存
					$thumb_img->save($file_path.$file_name_thumb);

		    }

	  	}

	  }


	  // メイン画像削除
	  if($request->mode == 'edit'){
	  	$remove_order_arr = explode(',',$request->remove_order_arr);
	  	if($remove_order_arr[0]){
	  		$remove_order_count = count($remove_order_arr);

	  		for($i=0; $i<$remove_order_count; $i++){

	  			$remove_order_num = $remove_order_arr[$i];

	  			// mimetype
	  			$mime_type = Imagepost::where('post_id', $post_id)
	  			->where('order_num', $remove_order_num)
	  			->first()->mimetype;

          switch($mime_type){
            case 'image/jpeg':
              $img_extension = "jpg";
              break;
            case 'image/png':
              $img_extension = "png";
              break;
            case 'image/gif':
              $img_extension = "gif";
              break;
          }


          // レコード削除
	  			DB::table('image_post')
	  			->where('post_id', $post_id)
	  			->where('order_num', $remove_order_num)
	  			->delete();


	  			// ファイル削除
					$delete_file = 'post_'.$post_id.'_'.$remove_order_num.'.'.$img_extension;
					$delete_thumb = 'post_'.$post_id.'_'.$remove_order_num.'_thumb.'.$img_extension;

					Storage::disk('local')->delete($user_id.'/'.$delete_file);
					Storage::disk('local')->delete($user_id.'/'.$delete_thumb);

	  		}


	  	}


	  }


		return redirect('/post/'.$post_id);
	}




	public function publish(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		$post_id = $request->post_id;

		$param = [
			'publish' => 1,
  		'updated_at' => time(),
		];

		DB::table('post')->where('id', $post_id)->update($param);

		return redirect('/post/'.$post_id);
	}



}
