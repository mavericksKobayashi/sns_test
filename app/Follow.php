<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{


	// テーブル名のカスタマイズ
	protected $table = 'follow';


  // フォローユーザー情報
	public function follow_users()
  {
  	return $this->belongsTo('App\Person','follow_id','id');
  }

  // フォロワーユーザー情報
	public function follower_users()
  {
  	return $this->belongsTo('App\Person','user_id','id');
  }

}

