<?php

namespace App\Http\Controllers;

use App\Post;
use App\Follow;
use App\Imagepost;
use App\Category;
use App\Tag;
use App\Like;
use App\Bookmark;
use App\Comment;
use App\Ranking;
use App\Ranking_m;
use App\Ranking_y;

use Session;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


	public function index(Request $request)
	{
		// ログイン判定
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		// ポストID
		$post_id = $request->post_id;

		// ポストが存在しない
		if(Post::find($post_id)){
			$post = Post::find($post_id);
	  } else {
	  	return redirect()->intended('/');
	  }

		// ポストユーザー
		$post_user = $post->post_user()->first();

		// 自分のポストかどうか
		$my_post = false;
		if($post_user->id == $user_id){
			$my_post = true;
		}


		// ポストは存在するが自分以外のポストで非公開設定になっているもの
		if($post->publish < 1 && !$my_post){
			return redirect()->intended('/');
		}

		// 自分のポストで非公開設定になっているもの
		$my_publish = true;
		if($post->publish < 1 && $my_post){
			$my_publish = false;
		}



		// 鍵アカ判定
		$locked_status =  $post_user->locked;
		if(!$my_post){
			if($locked_status == 1){
				if(
					Follow::where('user_id', $user_id)
					->where('follow_id', $post_user->id)
					->exists()
				) {
				} else {
					return redirect()->intended('home/');
				}
			}
		}



		// イメージ
		$mains = Imagepost::where('post_id',$post_id)
		->take(10)
		->get();

		// カテゴリー
		if($category = Category::find($post->category)){
			$category_name = $category->name;
			$category_name_en = $category->name_en;
		} else {
			$category_name = '';
			$category_name_en = '';
		}


		// タグ
		$tags = Tag::where('post_id',$post_id)->get();

		// 被ブックマーク数
		$bookmarked = Bookmark::where('post_id',$post_id)->count();

		// 被いいね数
		$liked = Like::where('post_id',$post_id)->count();

		// ログイン済みユーザーがいいねしてるか、ブクマしてるか
		$my_liked = 0;
		$my_booked = 0;
		if(isset($user)){

			$my_liked = Like::where('post_id',$post_id)
			->where('user_id',$user_id)
			->count();

			$my_booked = Bookmark::where('post_id',$post_id)
			->where('user_id',$user_id)
			->count();
		}

		// コメント アップデート昇順、id昇順
		$comments = Comment::orderBy('updated_at','asc')
		->orderBy('id','asc')
		->where('post_id',$post_id)
		->get();

		// ポジション
		$scr_pos = 0;
		if(Session::has('post_pos')){
			$scr_pos = session('post_pos');
		}

		// 緯度経度
		if($post->map){
			$latLng = explode(',',$post->map);
		} else {
			$latLng = [];
			$latLng[0] = '';
			$latLng[1] = '';
		}


		// 同じ場所のポスト アップデート降順、id降順、同じポストIDは除く
		$sames = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('map',$post->map)
		->where('id', '!=', $post_id)
		->take(100)
		->get();



		$param = [
			'user' => $user,
			'post' => $post,
			'post_user' => $post_user,
			'bookmarked' => $bookmarked,
			'liked' => $liked,

			'place_lat' => $latLng[0],
			'place_lng' => $latLng[1],

			'mains' => $mains,
			'category' => $category,
			'category_name' => $category_name,
			'category_name_en' => $category_name_en,
			'tags' => $tags,
			'comments' => $comments,

			'my_liked' => $my_liked,
			'my_booked' => $my_booked,
			'my_post' => $my_post,

			'scr_pos' => $scr_pos,
			'my_publish' => $my_publish,

			'sames' => $sames,

			'locked_status' => $locked_status,
		];

		return view('post',$param);
	}


	// いいねボタン
	public function add_like(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// ポストID
		$post_id = $request->post_id;

		// ポストユーザーID
		$post_user = $request->post_user;

		$my_checked = Like::where('post_id',$post_id)
			->where('user_id',$user_id)
			->count();

		// like テーブル
		if($my_checked > 0){
			//　いいね削除

			DB::table('like')->where('post_id', $post_id)
			->where('user_id',$user_id)
			->delete();

			// カウントダウン
			$new_count = Post::where('id',$post_id)->first()->like - 1;
			$upd_param = [
    		'like' => $new_count,
			];
			DB::table('post')->where('id', $post_id)->update($upd_param);

		} else {
			// いいね追加

			$param = [
				'user_id' => $user_id,
				'post_id' => $post_id,
				'created_at' => time(),
    		'updated_at' => time(),
			];
			DB::table('like')->insert($param);

			// カウントアップ
			$new_count = Post::where('id',$post_id)->first()->like + 1;
			$upd_param = [
    		'like' => $new_count,
			];
			DB::table('post')->where('id', $post_id)->update($upd_param);
		}


		// ranking テーブル
		$now_d = date('Ymd', time());
		$now_m = date('Ym', time());
		$now_y = date('Y', time());

		if($my_checked > 0){
			// カウントダウン

			$r_data = Ranking::where('post_id', $post_id)->where('date', $now_d)->first();
			if($r_data){
				$new_count = $r_data->count - 1;
				if($new_count > 0){
					$upd_param = [
    				'count' => $new_count,
					];
					DB::table('ranking')->where('post_id', $post_id)
					->where('date', $now_d)->update($upd_param);
				} else {
					DB::table('ranking')->where('post_id', $post_id)
					->where('date', $now_d)->delete();
				}
			}

			$r_data = Ranking_m::where('post_id', $post_id)->where('date', $now_m)->first();
			if($r_data){
				$new_count = $r_data->count - 1;
				if($new_count > 0){
					$upd_param = [
    				'count' => $new_count,
					];
					DB::table('ranking_m')->where('post_id', $post_id)
					->where('date', $now_m)->update($upd_param);
				} else {
					DB::table('ranking_m')->where('post_id', $post_id)
					->where('date', $now_m)->delete();
				}
			}

			$r_data = Ranking_y::where('post_id', $post_id)->where('date', $now_y)->first();
			if($r_data){
				$new_count = $r_data->count - 1;
				if($new_count > 0){
					$upd_param = [
    				'count' => $new_count,
					];
					DB::table('ranking_y')->where('post_id', $post_id)
					->where('date', $now_y)->update($upd_param);
				} else {
					DB::table('ranking_y')->where('post_id', $post_id)
					->where('date', $now_y)->delete();
				}
			}

		} else {
			// カウントアップ

			$r_data = Ranking::where('post_id', $post_id)->where('date', $now_d)->first();
			if($r_data){
				$new_count = $r_data->count + 1;
				$upd_param = [
    			'count' => $new_count,
				];
				DB::table('ranking')->where('post_id', $post_id)
					->where('date', $now_d)->update($upd_param);
			} else {
				$param = [
					'post_id' => $post_id,
					'count' => 1,
					'date' => $now_d,
    			'created_at' => time(),
    			'updated_at' => time(),
				];
				DB::table('ranking')->where('post_id', $post_id)
					->where('date', $now_d)->insert($param);
			}

			$r_data = Ranking_m::where('post_id', $post_id)->where('date', $now_m)->first();
			if($r_data){
				$new_count = $r_data->count + 1;
				$upd_param = [
    			'count' => $new_count,
				];
				DB::table('ranking_m')->where('post_id', $post_id)
					->where('date', $now_m)->update($upd_param);
			} else {
				$param = [
					'post_id' => $post_id,
					'count' => 1,
					'date' => $now_m,
    			'created_at' => time(),
    			'updated_at' => time(),
				];
				DB::table('ranking_m')->where('post_id', $post_id)
					->where('date', $now_m)->insert($param);
			}

			$r_data = Ranking_y::where('post_id', $post_id)->where('date', $now_y)->first();
			if($r_data){
				$new_count = $r_data->count + 1;
				$upd_param = [
    			'count' => $new_count,
				];
				DB::table('ranking_y')->where('post_id', $post_id)
					->where('date', $now_y)->update($upd_param);
			} else {
				$param = [
					'post_id' => $post_id,
					'count' => 1,
					'date' => $now_y,
    			'created_at' => time(),
    			'updated_at' => time(),
				];
				DB::table('ranking_y')->where('post_id', $post_id)
					->where('date', $now_y)->insert($param);
			}

		}


		// ポジション
		$post_pos = 0;
		if($request->post_pos > 0){
			$post_pos = $request->post_pos;
		}

		return redirect('/post/'.$post_id)->with('post_pos', $post_pos);
	}


	// ブックマークボタン
	public function add_bookmark(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// ポストID
		$post_id = $request->post_id;

		// ポストユーザーID
		$post_user = $request->post_user;

		$my_checked = Bookmark::where('post_id',$post_id)
			->where('user_id',$user_id)
			->count();

		if($my_checked > 0){
			//　ブックマーク削除

			DB::table('bookmark')->where('post_id', $post_id)
			->where('user_id',$user_id)
			->delete();

		} else {
			// ブックマーク追加

			$param = [
				'user_id' => $user_id,
				'post_id' => $post_id,
				'created_at' => time(),
    		'updated_at' => time(),
			];

			DB::table('bookmark')->insert($param);
		}

		// ポジション
		$post_pos = 0;
		if($request->post_pos > 0){
			$post_pos = $request->post_pos;
		}

		return redirect('/post/'.$post_id)->with('post_pos', $post_pos);
	}


	// コメント追加
	public function add_comment(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		// ポストID
		$post_id = $request->post_id;

		// コメントユーザーID
		$comment_user = $request->comment_user;


			$param = [
				'post_id' => $post_id,
				'user_id' => $comment_user,
				'comment' => $request->comment,
				'created_at' => time(),
    		'updated_at' => time(),
			];

			DB::table('comment')->insert($param);


		// ポジション
		$post_pos = 0;
		if($request->post_pos > 0){
			$post_pos = $request->post_pos;
		}

		return redirect('/post/'.$post_id)->with('post_pos', $post_pos);
	}


}
