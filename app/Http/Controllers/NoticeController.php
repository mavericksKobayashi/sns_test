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
use App\Message_block;
use App\Message;
use App\News;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{

	// 通知一覧
	public function notice(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		$news_lists = News::orderBy('release_date', 'desc')
		->orderBy('updated_at', 'desc')
		->where('publish','1')
		->get();

		$time = new Carbon(Carbon::now());

		$param = [
			'user' => $user,
			'user_id' => $user_id,
			'news_lists' => $news_lists,
		];


		return view('user.notice',$param);
	}

	// お知らせ詳細
	public function news(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;

		$news = News::where('id', $request->news_id)
		->first();

		$param = [
			'user' => $user,
			'user_id' => $user_id,
			'news' => $news,
		];


		return view('news',$param);
	}

}
