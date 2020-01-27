<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{


	//テーブル名のカスタマイズ
	protected $table = 'users';


	// フォロー情報
	public function follows()
  {
  	return $this->hasMany('App\Follow','user_id','id');
  }

  // ブックマーク情報
	public function bookmarks()
  {
  	return $this->hasMany('App\Bookmark','user_id','id');
  }

	public function Message_blocks()
  {
  	return $this->hasMany('App\Message_block','user_id','id');
  }


}
