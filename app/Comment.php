<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


	// テーブル名のカスタマイズ
	protected $table = 'comment';


	// ユーザー情報
	public function comment_users()
  {
  	return $this->hasOne('App\Person','id','user_id');
  }

}

