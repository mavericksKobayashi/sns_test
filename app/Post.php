<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	// テーブル名のカスタマイズ
	protected $table = 'post';

	// ポストイメージ情報
	public function post_image()
  {
  	return $this->hasMany('App\Imagepost','post_id','id');
  }

  // カテゴリー情報
	public function post_category()
  {
  	return $this->hasOne('App\Category','id','category');
  }

  // ユーザー情報
  public function post_user()
  {
    return $this->hasOne('App\Person','id','user_id');
  }

  public function freeze_user()
  {
    return $this->hasMany('App\Person','id','user_id');
  }

  public function post_user_key(){
    return $this->hasOne('App\Person','id','user_id');
  }

	// ユーザー情報
  public function post_tag()
  {
    return $this->hasMany('App\Tag','post_id','id');
  }

	public function order($select)
	{
	    if($select == 'asc'){
	        return $this->orderBy('created_at', 'asc')->get();
	    } elseif($select == 'desc') {
	        return $this->orderBy('created_at', 'desc')->get();
	    } else {
	        return $this->all();
	    }
	}
}
