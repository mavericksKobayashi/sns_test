@php
if($freeze == 1){
  header('Location: /freeze');
  exit;
}
if(date_default_timezone_get() != "Asia/Tokyo"){
  date_default_timezone_set("Asia/Tokyo");
}
@endphp
<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>FLIP Discover the world!</title>
  <meta name="keywords" content="FLIP,旅行,SNS,webアプリケーション,旅するSNS,簡単">
  <meta name="description" content="旅先で生まれたあなただけの物語。ふと訪れた街角で経験した感動エピソード。ガイドブックにはないホットな現地情報。flipは旅のコラムやクチコミ情報を簡単にシェアできるトラベラーズSNS。エリアで絞り込んだり投稿者をフォローしたり、ユーザー同士の交流だってできちゃう。初心者から旅慣れたエキスパートまで、旅を愛するすべての人に。">
<!-- Google Tag Manager -->

<!-- End Google Tag Manager -->

<!-- Styles -->
<link href="{{ asset('css/jquery.slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/common.css') }}" rel="stylesheet">

<!-- font -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" integrity="sha384-wxqG4glGB3nlqX0bi23nmgwCSjWIW13BdLUEYC4VIMehfbcro/ATkyDsF/AbIOVe" crossorigin="anonymous">

<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.slick.min.js') }}"></script>
<script src="{{ asset('js/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/ofi.min.js') }}"></script>
<script>
  objectFitImages('.object-fit');
</script>
