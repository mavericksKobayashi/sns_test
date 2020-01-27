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

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{


	// メッセージ一覧
	public function message(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;

		// 受信から見たブロック
		$receiver_blocks =  Person::find($user_id)
		->Message_blocks()
		->get();
		$receiver_blocks_user = array();
		foreach ($receiver_blocks as $receiver_block) {
			array_push($receiver_blocks_user,$receiver_block->block_id);
		}

		// 送信から見たブロック
		$transmitter_blocks =  Person::find($user_id)
		->Message_blocks()
		->get();
		$transmitter_blocks_user = array();
		foreach ($transmitter_blocks as $transmitter_block) {
			array_push($transmitter_blocks_user,$transmitter_block->block_id);
		}


		//送信ユーザーから見た受信者リスト取得
		$former_messages = Message::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where(function ($query) use ($user_id){
        $query->where('user_id', $user_id)
				->orwhere('message_user_id', $user_id);
    })
		->get();

		$message_lists = array();
		foreach ($former_messages as $former_message) {
			array_push($message_lists,$former_message->message_user_id);
		}

		$message_id_lists = array_diff($message_lists, array($user_id));
		$message_id_lists = array_values($message_id_lists);
		//送信ユーザーから見た受信者リスト取得終わり

		//リスト作成 アップデート降順、id降順
		$messages = Message::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where(function ($query) use ($user_id){
				$query->where('user_id', $user_id)
				->orwhere('message_user_id', $user_id);
		})
		->wherehas('receiver', function ($query) use ($receiver_blocks_user){
			$query->whereNotIn('id', $receiver_blocks_user)
			->whereNotIn('freeze', [1]);
		})
		->wherehas('transmitter', function ($query) use ($transmitter_blocks_user){
			$query->whereNotIn('id', $transmitter_blocks_user)
			->whereNotIn('freeze', [1]);
		})
		->whereNotIn('user_id', $message_id_lists)
		->groupBy('message_group')
		->get();

		// カウント
		$messages_count = $messages->count();

		$param = [
			'user' => $user,
			'user_id' => $user_id,
			'messages' => $messages,
			'receiver_blocks' => $receiver_blocks,
			'transmitter_blocks' => $transmitter_blocks,
		];


		return view('user.message',$param);
	}

	// メッセージブロック一覧
	public function block(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;

		// 受信から見たブロック
		$receiver_blocks =  Person::find($user_id)
		->Message_blocks()
		->get();
		$receiver_blocks_user = array();
		foreach ($receiver_blocks as $receiver_block) {
			array_push($receiver_blocks_user,$receiver_block->block_id);
		}

		// 受信から見たブロック
		$transmitter_blocks =  Person::find($user_id)
		->Message_blocks()
		->get();
		$transmitter_blocks_user = array();
		foreach ($transmitter_blocks as $transmitter_block) {
			array_push($transmitter_blocks_user,$transmitter_block->block_id);
		}

		//送信ユーザーから見た受信者リスト取得
		$former_messages = Message::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where(function ($query) use ($user_id){
				$query->where('user_id', $user_id)
				->orwhere('message_user_id', $user_id);
		})
		->get();

		$message_lists = array();
		foreach ($former_messages as $former_message) {
			array_push($message_lists,$former_message->message_user_id);
		}

		$message_id_lists = array_diff($message_lists, array($user_id));
		$message_id_lists = array_values($message_id_lists);
		//送信ユーザーから見た受信者リスト取得終わり

		//リスト作成
		$messages = Message::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where(function ($query) use ($user_id){
				$query->where('user_id', $user_id)
				->orwhere('message_user_id', $user_id);
		})
		->wherehas('receiver', function ($query) use ($receiver_blocks_user){
			$query->whereIn('id', $receiver_blocks_user)
			->whereNotIn('freeze', [1]);
		})
		->orwherehas('transmitter', function ($query) use ($transmitter_blocks_user){
			$query->whereIn('id', $transmitter_blocks_user)
			->whereNotIn('freeze', [1]);
		})
		->whereNotIn('user_id', $message_id_lists)
		->groupBy('message_group')
		->get();

		// カウント
		$messages_count = $messages->count();

		$param = [
			'user' => $user,
			'user_id' => $user_id,
			'messages' => $messages,
			'receiver_blocks' => $receiver_blocks,
			'transmitter_blocks' => $transmitter_blocks,
		];


		return view('user.message_block',$param);
	}

	//メッセージ
	public function switching(Request $request)
	{
		//Auth::logout();

		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}

		$user_id = $user->id;
		$nickname = $user->nickname;

		$message_user_id = $request->message_user_id;
		$message_user_nickname = Person::where('id', $message_user_id)
		->first()
		->nickname;

		// アップデート降順、id降順
		$messages = Message::orderBy('updated_at','desc')
		->orderBy('id','desc')
		->where(function($query) use ($user_id, $message_user_id){
			$query->where('user_id', $user_id)
			->orwhere('message_user_id', $user_id);
		})
		->where(function($query) use ($user_id, $message_user_id){
			$query->where('user_id', $message_user_id)
			->orwhere('message_user_id', $message_user_id);
		})
		->get();

		// カウント
		$messages_count = $messages->count();

		$param = [
			'user' => $user,
			'user_id' => $user_id,
			'nickname' => $nickname,
			'messages' => $messages,
			'message_user_id' => $message_user_id,
			'message_user_nickname' => $message_user_nickname,
		];


		return view('user.switching',$param);
	}

	// メッセージ送信
	public function add_message(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;
		$message_user_id = $request->message_user_id;


			$param = [
				'user_id' => $user_id,
				'message_user_id' => $message_user_id,
				'message_cont' => $request->message_cont,
				'message_group' => $user_id.$message_user_id,
				'created_at' => time(),
				'updated_at' => time(),
			];

			DB::table('message')->insert($param);

		return redirect('/user_message/'.$message_user_id);
	}

	// ブロック解除
	public function block_remove(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;
		$message_user_id = $request->message_user_id;

		// ブロック解除：delete

		DB::table('message_block')
		->where('user_id', $user->id)
		->where('block_id', $request->nm_block)
		->delete();


		return redirect('/user_message_block/');
	}

	public function block_add(Request $request)
	{
		// 要ログイン
		$user = Auth::user();
		if(is_null($user)){
			return redirect()->intended('/');
		}
		$user_id = $user->id;
		$message_user_id = $request->message_user_id;

		// ブロック
		$param = [
			'user_id' => $user->id,
			'block_id' => $request->nm_block,
			'created_at' => time(),
			'updated_at' => time(),
		];

		DB::table('message_block')->insert($param);


		return redirect('/user_message/');
	}

}
