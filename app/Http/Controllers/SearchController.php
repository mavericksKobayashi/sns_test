<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{


	public function category(Request $request)
	{
		// ログイン判定
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		$list_name = $request->list_name;

		if($list_name == '国内旅行'){

			// カテゴリーリスト
			$cat_arr =  Category::where('parent', 1)->get(['id']);
			$cat_arr->toArray();

			// ポスト 公開設定されているもの アップデート降順、id降順
			$posts = Post::orderBy('updated_at','desc')
			->orderBy('id','desc')
			->whereIn('category', $cat_arr)
			->where('publish', '>', 0)
			->paginate(100);

		} else if($list_name == '海外旅行'){

			// カテゴリーリスト
			$cat_arr =  Category::where('parent', 2)->get(['id']);
			$cat_arr->toArray();

			// ポスト 公開設定されているもの アップデート降順、id降順
			$posts = Post::orderBy('updated_at','desc')
			->orderBy('id','desc')
			->whereIn('category', $cat_arr)
			->where('publish', '>', 0)
			->paginate(100);

		} else {

			// カテゴリーリスト
			$cat_num =  Category::where('name', $list_name)
			->first()
			->id;

			// ポスト 公開設定されているもの アップデート降順、id降順
			$posts = Post::orderBy('updated_at','desc')
			->orderBy('id','desc')
			->where('category', $cat_num)
			->where('publish', '>', 0)
			->paginate(100);

		}

		if(count($posts) < 1){
			$no_post = true;
		} else {
			$no_post = false;
		}

		$list_name_en = Category::where('name', $request->list_name)
		->first();
		$category_name_en = $list_name_en->name_en;

		$param = [
			'user' => $user,
			'posts' => $posts,
			'category_name_en' => $category_name_en,

			'page_name' => 'カテゴリー',
			'page_name_en' => 'Category',
			'list_name' => $list_name,
			'no_post' => $no_post,
		];

		return view('list',$param);
	}


	public function tag(Request $request)
	{
		// ログイン判定
		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		$list_name = $request->list_name;

		// タグリスト
		$tag_lists =  Tag::where('name', $list_name)
		->get();

		$tag_arr = [];
		foreach ($tag_lists as $tag_list) {
			array_push($tag_arr,$tag_list->post_id);
		}

		// ポスト 公開設定されているもの アップデート降順、id降順
		$posts = Post::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->whereIn('id', $tag_arr)
		->where('publish', '>', 0)
		->paginate(100);

		$param = [
			'user' => $user,
			'posts' => $posts,

			'page_name' => 'タグ',
			'list_name' => $list_name,
		];

		return view('list',$param);
	}

	public function index(Request $request)
	{
		//Auth::logout();
		$keyword = $request->input('keyword');

		$user = Auth::user();
		if(is_null($user)){
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		if(!empty($keyword))
	  {

			$posts = Post::orderBy('updated_at','desc')
			->where(function($query){
				$query->where('publish', '>', 0)
				->wherehas('freeze_user', function ($query){
					$query->where('freeze','<', 1);
				});
			})
			->where(function($query) use ($keyword){
				$query->where('place','like','%'.$keyword.'%')
				->orWhere('contents','like','%'.$keyword.'%')
				->orWherehas('post_category', function ($query) use ($keyword) {
					$query->where('name','like','%'.$keyword.'%');
				})
				->orWherehas('post_user', function ($query) use ($keyword) {
					$query->where('nickname','like','%'.$keyword.'%')
					->orWhere('self_intro','like','%'.$keyword.'%');
				})
				->orWherehas('post_tag', function ($query) use ($keyword) {
					$query->where('name','like','%'.$keyword.'%');
				});
			})
			->paginate(0);

	  } else {
			$posts = Post::orderBy('updated_at','desc')
			->orderBy('id','desc')
			->where('publish', '>', 2)
			->wherehas('freeze_user', function ($query){
				$query->where('freeze','<', 1);
			})
			->take(24)
			->get();
			$cat = Post::whereHas('post_category', function($query) {
			$query->where('name');
			})->get();
	  }

		$param = [
			'user' => $user,
			'posts' => $posts,
			'from' => 'defo',
			'count' => '$count',
			'tab' => 'search',
		];


		return view('search',$param)->with('keyword',$keyword);

	}


}
