<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップページ
Route::get('/','TopController@index');

// about
Route::get('about', function () { return view('about'); });


// ユーザーログイン
Route::get('login','LoginController@index');
Route::post('login','LoginController@postAuth');

Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|twitter');
//コールバック用
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|twitter');


// ユーザーログアウト
Route::get('logout','LogoutController@index');

// 凍結
Route::get('freeze','FreezeController@index');

// パスワード再発行
Route::get('resetpassword','ResetpasswordController@index');
Route::post('resetpassword','ResetpasswordController@reset');

// 新規アカウント作成
Route::get('register/create','RegisterController@index');
Route::post('register/create','RegisterController@postRegister');

// 新規アカウント作成 → おすすめユーザーのフォロー
Route::get('register/follow','RegisterController@follow');
Route::post('register/follow','RegisterController@postFollow');

// ログイン後のユーザーホーム
Route::get('home','UserController@home');
Route::get('home/recommend','UserController@recommend');
Route::get('home/pickup','UserController@pickup');
Route::get('home/popular','UserController@popular');
Route::get('home/arrival','UserController@arrival');

// 記事作成
Route::get('create','CreateController@index');
Route::post('create','CreateController@post');

// 記事編集
Route::get('edit/{post_id?}','CreateController@edit');

// 今すぐ公開
Route::get('publish/{post_id?}','CreateController@publish');


// 記事（ポスト）
Route::get('post/{post_id?}','PostController@index');
// いいねボタンクリック
Route::get('add_like/{post_id?}/{post_user?}/{post_pos?}','PostController@add_like');
// ブックマーククリック
Route::get('add_bookmark/{post_id?}/{post_user?}/{post_pos?}','PostController@add_bookmark');
// コメント送信
Route::get('add_comment/{post_id?}/{comment_user?}/{post_pos?}','PostController@add_comment');

// ブックマーク
Route::get('bookmark','BookmarkController@index');

// ランキング
Route::get('ranking_w','RankingController@week');
Route::get('ranking_m','RankingController@month');
Route::get('ranking_y','RankingController@year');

//おすすめtop20
Route::get('recommend','RankingController@recommend');

//話題top20
Route::get('topic','RankingController@topic');

// ホット
Route::get('hot','HotController@index');

// 検索
// Route::get('search', function () { return view('search'); });
Route::get('search','SearchController@index');
// Route::post('search','SearchController@post');

// カテゴリー
// Route::get('category/', function () { return redirect('/user/'); });
Route::get('category/{list_name?}','SearchController@category');

// タグ
Route::get('tag/', function () { return redirect('/user/'); });
Route::get('tag/{list_name?}','SearchController@tag');

// ユーザーページ
Route::get('user/{user_id?}','UserController@index');
Route::post('user/{user_id?}','UserController@postIndex');

// ユーザー情報編集
Route::get('user_edit','UserController@edit');
Route::post('user_edit','UserController@post');

// ユーザーフォロー
Route::get('user_follow/{user_id?}','UserController@follow');
Route::post('user_follow/{user_id?}','UserController@postFollow');

// ユーザーフォロワー
Route::get('user_follower/{user_id?}','UserController@follower');
Route::post('user_follower/{user_id?}','UserController@postFollower');

// メッセージ一覧
Route::get('user_message/','MessageController@message');

// メッセージ
Route::get('user_message/{message_user_id?}','MessageController@switching');
Route::post('user_message/{message_user_id?}','MessageController@block_add');

//メッセージ送信
Route::get('add_message/{message_user_id?}','MessageController@add_message');

// メッセージブロック一覧
Route::get('user_message_block/','MessageController@block');
Route::post('user_message_block/','MessageController@block_remove');

// 通知一覧
Route::get('notice','NoticeController@notice');

// ニュース詳細
Route::get('news/{news_id?}','NoticeController@news');

// 管理画面
Route::get('admin','AdminController@index');

// 管理画面ユーザー
Route::get('admin/user','AdminController@user');
Route::get('admin/user_edit/{edit_user_id?}','AdminController@user_edit');
Route::post('admin/user_edit/{edit_user_id?}','AdminController@user_edit_post');

// 管理画面投稿
Route::get('admin/post','AdminController@post');
Route::post('admin/post/{post_id?}','AdminController@post_freeze');

// 管理画面通報
Route::get('admin/report', function () { return view('admin.report'); });
// 管理画面ニュース
Route::get('admin/news','AdminController@news');
Route::get('admin/news_create','AdminController@news_create');
Route::get('admin/news_edit/{news_id?}','AdminController@news_edit');
Route::post('admin/news_create','AdminController@news_create_post');
Route::post('admin/news_edit/{news_id?}','AdminController@news_edit_post');

// 管理画面お問い合わせ メッセージ機能使用
// Route::get('admin/contact', function () { return view('admin.contact'); });
// Route::get('admin/contact_detail', function () { return view('admin.contact_detail'); });

//sns認証
Route::get('auth/login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('auth/login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
/**
 * 言語切替
 */
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
