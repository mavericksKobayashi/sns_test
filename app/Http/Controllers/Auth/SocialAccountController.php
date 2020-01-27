<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;

class SocialAccountController extends Controller
{
  public function redirectToProvider($provider) {
      return Socialite::driver($provider)->redirect();
  }

  public function handleProviderCallback($provider) {
    try {
      $providerUser = Socialite::driver($provider)->user();

      $user = DB::table('users')->where('email', $providerUser->getEmail())->first();

      if( is_null($user) ){

        if( is_null($providerUser->getNickname()) ){
          $providerUserNickName = $providerUser->getName();
        }else{
          $providerUserNickName = $providerUser->getNickname();
        }

        $userd = User::create([
          'name' => $providerUserNickName,
          'email' => $providerUser->getEmail(),
        ]);

      }else{
        $userd = User::find( $user->id );
      }

      switch ($provider) {
        case "facebook":
          if( is_null($userd->facebbook_id) ){
            $userd->facebook_id = $providerUser->getId();
            if( is_null($providerUser->getNickname()) ){
              $userd->facebook_name = $providerUser->getName();
            }else{
              $userd->facebook_name =$providerUser->getNickname();
            }
          }
          break;
        case "twitter":
          if( is_null($userd->twitter_id) ){
            $userd->twitter_id = $providerUser->getId();
            if( is_null($providerUser->getNickname()) ){
              $userd->twitter_name = $providerUser->getName();
            }else{
              $userd->twitter_name = $providerUser->getNickname();
            }
          }
          break;
      }
      $userd->save();

      auth()->login($userd, true);
      return redirect()->to('/home');

    } catch (\Exception $e) {
      return redirect("/");
    }

  }
}
