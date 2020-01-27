<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{


	// テーブル名のカスタマイズ
	protected $table = 'message';

	//送信者
	public function transmitter()
  {
  	return $this->belongsTo('App\Person','user_id','id');
  }

  // 受信者
	public function receiver()
  {
  	return $this->belongsTo('App\Person','message_user_id','id');
  }

	// 受信から見たブロック
  public function receiver_blocks()
  {
    return $this->hasMany('App\Message_block','block_id','message_user_id');
  }

	// 送信から見たブロック
  public function transmitter_blocks()
  {
    return $this->hasMany('App\Message_block','block_id','user_id');
  }

}
