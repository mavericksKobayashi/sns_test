<?php

namespace App\Http\Controllers;

use App\Post;
use App\Ranking_m;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class HotController extends Controller
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


		//現在の年月日 → タイムスタンプ
		$time = new Carbon(Carbon::now());
		$today = Carbon::create($time->year, $time->month, $time->day, 0, 0, 0);
		$today_ts = $today->timestamp;

		// current_month
		$current_month = $today;

		// 月の検索文言
		$month_date = $current_month->format('Ym');

		// 月別ランキングリスト
		$rankings = Ranking_m::where('date',$month_date)
		->get();



		$id_ary = array();
		$ranking_arr = array();
		

		foreach($rankings as $ranking){

			if(in_array($ranking->post_id,$id_ary)) {

				//echo "重複------";

				$add_count = $ranking_arr[$ranking->post_id]+$ranking->count;
				unset($ranking_arr[$ranking->post_id]);
				$ranking_arr += array($ranking->post_id => $add_count);

			} else {

				//echo "新規------";

				$id_ary[] = $ranking->post_id;
				$ranking_arr += array($ranking->post_id => $ranking->count);
				
			}

		}

		// 降順ソート
		arsort($ranking_arr);


		$ranking_id_arr = array();
		foreach($ranking_arr as $kye=>$value){
			array_push($ranking_id_arr,$kye);
		}
 
		$placeholder = '';
		foreach ($ranking_id_arr as $key => $value) {
			$placeholder .= ($key == 0) ? '?' : ',?';
		}
		if($ranking_id_arr){
			$posts = Post::whereIn('id', $ranking_id_arr)->orderByRaw("FIELD(id, $placeholder)",$ranking_id_arr)->get();
		} else {
			$posts = '';
		}

		$param = [
			'user' => $user,
			'posts' => $posts,
		];

		return view('hot',$param);
	}


}

