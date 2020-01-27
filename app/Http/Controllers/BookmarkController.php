<?php

namespace App\Http\Controllers;

use App\Person;
use App\Bookmark;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{


	public function index(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;

		// ブックマークリスト
		$bookmarks =  Person::find($user_id)
		->bookmarks()
		->get();

		$bookmark_arr = [];
		foreach ($bookmarks as $bookmark) {
			array_push($bookmark_arr,$bookmark->post_id);
		}

		// ポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->whereIn('id', $bookmark_arr)
		->where('publish', '>', 0)
		->paginate(100);

		$param = [
			'user' => $user,
			'posts' => $posts,

		];


		return view('clip',$param);

	}

}

