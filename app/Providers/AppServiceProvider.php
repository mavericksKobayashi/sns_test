<?php

namespace App\Providers;

use App\Category;
use App\Tag;
use App\Person;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
      //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {

    // カテゴリー
    view()->composer('components.post_side_menu', function($view) {
      $view->with('category_names', Category::get());
    });
    // 全bladeファイルで使いたい時
    //view()->share('category_names', Category::get());



    // 人気のタグ
    view()->composer('components.post_side_menu', function($view) {

    	$tagViewsArr = [];
      $tagViews = Tag::get();
      foreach($tagViews as $tagView){
        array_push($tagViewsArr,$tagView->name);
      }

      $counts = array_count_values($tagViewsArr);
			arsort($counts);
			$vals = array_keys($counts);

      $view->with('tag_names', $vals);
    });

    view()->composer('components.header', function($view) {

      // 要ログイン
      $user = Auth::user();
      if(!is_null($user)){
        $user_id = $user->id;
        $user_data = Person::where('id', $user_id)
        ->first();
        $freeze = $user_data->freeze;
      } else {
        $freeze = '';
      }

      $view->with('freeze', $freeze);
    });
  }
}
