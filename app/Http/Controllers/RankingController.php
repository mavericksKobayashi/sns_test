<?php

namespace App\Http\Controllers;

use App\Person;
use App\Post;
use App\Ranking;
use App\Ranking_m;
use App\Ranking_y;
use App\Category;
use App\Imagepost;


use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{


	public function recommend(Request $request)
	{

		$user = Auth::user();

		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}


		//おすすめ-----------
		// レート4以上のポスト 公開設定されているもの アップデート降順、id降順
		$recommend_lists = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where('rating', '>', 3)
		->where('publish', '>', 0)
		->take(20)
		->get();

		$lists = array();
		$recommend_num = 1;
		foreach ($recommend_lists as $recommend_list) {

			$recommend_post_id = $recommend_list->id;

			$recommend_post_user_id = $recommend_list->user_id;

			$recommend_post_day = $recommend_list->created_at->format('Y-m-d');

			$recommend_post_place = $recommend_list->place;

			$recommend_post_like = $recommend_list->like;


			$recommend_post_user = Person::where('id',$recommend_post_user_id)
			->first();

			$recommend_post_user_name = $recommend_post_user->nickname;

			if($post_images = Imagepost::where('post_id',$recommend_post_id)
				->first()){
				$post_image_type = $post_images->type;
				$order_num = $post_images->order_num;
			} else {
				$post_image_type = '';
				$order_num = '';
			}

			$val_arr = array(
				$recommend_num,//0　ランキング番号
				$recommend_post_id,//1　ポストID
				$recommend_post_user_id,//2　ポストユーザーID
				$recommend_post_user_name,//3　ポストユーザーネーム
				$recommend_post_day,//4　ポストの作成日
				$recommend_post_place,//5　ポストのピンの場所
				$recommend_post_like,//6　ポスト週間いいね数
				$post_images,//7　イメージの有無
				$order_num,//8　イメージナンバー
				$post_image_type,//9　イメージのタイプ
				);

			array_push($lists,$val_arr);

			$recommend_num++;
			if($recommend_num>20){
				break;
			}
		}
		//おすすめEND-----------

		$param = [
			'user' => $user,
			'tab' => 'recommend',
			'lists' => $lists,
		];


		return view('ranking',$param);

	}

	public function week(Request $request)
	{
		$user = Auth::user();

		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		//ランキング-----------
		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日
		$yesterday = $time->subDay();
		$yesterday = $yesterday->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から一週間前
		$one_week_before = $time->subDay(6);
		$one_week_before = $one_week_before->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から１ヶ月前
		$one_month_before = $time->subMonth();
		$one_month_before = $one_month_before->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から１年前
		$one_year_before = $time->subYear();
		$one_year_before = $one_year_before->timestamp;

		$time = new Carbon(Carbon::today());
		$time = $time->timestamp;

		//週間ランキング
		$ranking_w_lists = post::where('created_at', '<', $time)
		->where('created_at', '>=', $one_week_before)
		->orderBy('like','desc')
		->take(20)
		->get();

		$lists = array();
		$ranking_w_num = 1;
		foreach ($ranking_w_lists as $ranking_w_list) {

			$ranking_w_post_id = $ranking_w_list->id;

			$ranking_w_post_user_id = $ranking_w_list->user_id;

			$ranking_w_post_user = Person::where('id',$ranking_w_post_user_id)
			->first();

			$ranking_w_post_user_name = $ranking_w_post_user->nickname;

			$ranking_w_post_day = $ranking_w_list->created_at->format('Y-m-d');

			$ranking_w_post_place = $ranking_w_list->place;

			$ranking_w_post_like = $ranking_w_list->like;

			if($post_images = Imagepost::where('post_id',$ranking_w_post_id)
				->first()){
				$post_image_type = $post_images->type;
				$order_num = $post_images->order_num;
			} else {
				$post_image_type = '';
				$order_num = '';
			}

			$val_arr = array(
				$ranking_w_num,//0　ランキング番号
				$ranking_w_post_id,//1　ポストID
				$ranking_w_post_user_id,//2　ポストユーザー
				$ranking_w_post_user_name,//3　ポストユーザーネーム
				$ranking_w_post_day,//4　ポストの作成日
				$ranking_w_post_place,//5　ポストのピンの場所
				$ranking_w_post_like,//6　ポスト週間いいね数
				$post_images,//7　イメージの有無
				$order_num,//8　イメージナンバー
				$post_image_type,//9　イメージのタイプ
				);

			array_push($lists,$val_arr);

			$ranking_w_num++;
			if($ranking_w_num>20){
				break;
			}
		}


		$param = [
			'user' => $user,
			'tab' => 'week',
			'lists' => $lists,
		];


		return view('ranking',$param);
	}


	public function month(Request $request)
	{
		$user = Auth::user();

		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		//ランキング-----------
		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日
		$yesterday = $time->subDay();
		$yesterday = $yesterday->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から一週間前
		$one_week_before = $time->subDay(6);
		$one_week_before = $one_week_before->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から１ヶ月前
		$one_month_before = $time->subMonth();
		$one_month_before = $one_month_before->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から１年前
		$one_year_before = $time->subYear();
		$one_year_before = $one_year_before->timestamp;

		$time = new Carbon(Carbon::today());
		$time = $time->timestamp;

		//月間ランキング
		$ranking_m_lists = post::where('created_at', '<', $time)
		->where('created_at', '>=', $one_month_before)
		->orderBy('like','desc')
		->take(20)
		->get();

		$lists = array();
		$ranking_m_num = 1;
		foreach ($ranking_m_lists as $ranking_m_list) {

			$ranking_m_post_id = $ranking_m_list->id;

			$ranking_m_post_user_id = $ranking_m_list->user_id;

			$ranking_m_post_user = Person::where('id',$ranking_m_post_user_id)
			->first();

			$ranking_m_post_user_name = $ranking_m_post_user->nickname;

			$ranking_m_post_day = $ranking_m_list->created_at->format('Y-m-d');

			$ranking_m_post_place = $ranking_m_list->place;

			$ranking_m_post_like = $ranking_m_list->like;

			if($post_images = Imagepost::where('post_id',$ranking_m_post_id)
				->first()){
				$post_image_type = $post_images->type;
				$order_num = $post_images->order_num;
			} else {
				$post_image_type = '';
				$order_num = '';
			}

			$val_arr = array(
				$ranking_m_num,//0　ランキング番号
				$ranking_m_post_id,//1　ポストID
				$ranking_m_post_user_id,//2　ポストユーザー
				$ranking_m_post_user_name,//3　ポストユーザーネーム
				$ranking_m_post_day,//4　ポストの作成日
				$ranking_m_post_place,//5　ポストのピンの場所
				$ranking_m_post_like,//6　ポスト週間いいね数
				$post_images,//7　イメージの有無
				$order_num,//8　イメージナンバー
				$post_image_type,//9　イメージのタイプ
				);

			array_push($lists,$val_arr);

			$ranking_m_num++;
			if($ranking_m_num>20){
				break;
			}
		}

		$param = [
			'user' => $user,
			'tab' => 'month',
			'lists' => $lists,
		];


		return view('ranking',$param);
	}


	public function topic(Request $request)
	{
		$user = Auth::user();

		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		//ランキング-----------
		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日
		$yesterday = $time->subDay();
		$yesterday = $yesterday->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から一週間前
		$one_week_before = $time->subDay(6);
		$one_week_before = $one_week_before->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から１ヶ月前
		$one_month_before = $time->subMonth();
		$one_month_before = $one_month_before->timestamp;

		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::today());
		//昨日から１年前
		$one_year_before = $time->subYear();
		$one_year_before = $one_year_before->timestamp;

		$time = new Carbon(Carbon::today());
		$time = $time->timestamp;

		//月間ランキング
		$ranking_y_lists = post::where('created_at', '<', $time)
		->where('created_at', '>=', $one_month_before)
		->orderBy('like','desc')
		->take(20)
		->get();

		$lists = array();
		$ranking_y_num = 1;
		foreach ($ranking_y_lists as $ranking_y_list) {

			$ranking_y_post_id = $ranking_y_list->id;

			$ranking_y_post_user_id = $ranking_y_list->user_id;

			$ranking_y_post_user = Person::where('id',$ranking_y_post_user_id)
			->first();

			$ranking_y_post_user_name = $ranking_y_post_user->nickname;

			$ranking_y_post_day = $ranking_y_list->created_at->format('Y-m-d');

			$ranking_y_post_place = $ranking_y_list->place;

			$ranking_y_post_like = $ranking_y_list->like;

			if($post_images = Imagepost::where('post_id',$ranking_y_post_id)
				->first()){
				$post_image_type = $post_images->type;
				$order_num = $post_images->order_num;
			} else {
				$post_image_type = '';
				$order_num = '';
			}

			$val_arr = array(
				$ranking_y_num,//0　ランキング番号
				$ranking_y_post_id,//1　ポストID
				$ranking_y_post_user_id,//2　ポストユーザー
				$ranking_y_post_user_name,//3　ポストユーザーネーム
				$ranking_y_post_day,//4　ポストの作成日
				$ranking_y_post_place,//5　ポストのピンの場所
				$ranking_y_post_like,//6　ポスト週間いいね数
				$post_images,//7　イメージの有無
				$order_num,//8　イメージナンバー
				$post_image_type,//9　イメージのタイプ
				);

			array_push($lists,$val_arr);

			$ranking_y_num++;
			if($ranking_y_num>20){
				break;
			}
		}

		$param = [
			'user' => $user,
			'tab' => 'topic',
			'lists' => $lists,
		];


		return view('ranking',$param);
	}


}
