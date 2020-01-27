@include('components.header')
<link href="{{ asset('css/about.css') }}" rel="stylesheet">

</head>

<body id="about">
  @include('components.menu')
  <div class="breadcrumb">
    <div class="inner">
      <a href="#">FLIPとは</a>
    </div>
  </div>
  <div class="mv">
    <img src="{{ asset('img/mv_about_sp.jpg') }}" alt="" class="switch object-fit">
    <div class="mv_text">
      <h1 class="ttl"><span>FLIP</span><span>で</span><br><span>旅</span>はもっと<br><span>楽</span>しくなる<span>!!</span></h1>
    </div>
  </div>
  <div class="content">

    <div class="main">
      <div class="about_box">
        <ul>
          <li>行きたい場所を見つけたい!</li>
          <li>旅行前や旅先で現地の情報を知りたい!</li>
          <li>自分でも情報を発信したい!</li>
          <li>行きたい場所を見つけたい!</li>
          <li>ほかの旅人と知り合いたい!</li>
          <li>一緒に旅する仲間を見つけたい!</li>
        </ul>
      </div>

      <div class="step">
        <div class="top">
          <div class="inner">
            <h2 class="ttl"><span>FLIP</span><span>を</span><br><span>使</span>ってみよう!!</h2>
          </div>
        </div>
        <div class="inner">
          <div class="step_box">
            <p class="step_num">Step 1</p>
            <h3 class="step_ttl">エリアをフォローして旅先の今を知る</h3>
            <p class="step_txt">興味のあるエリアをフォローすれば、そのエリアの投稿のみがタイムラインに表示されます。旅行前の行動計画に、旅行中の情報収集に役立つでしょう。</p>
            <div class="img_area img_area_1">
              <img src="{{ asset('img/about_1.svg') }}" alt="">
            </div>
          </div>

          <div class="step_box">
            <p class="step_num">Step 2</p>
            <h3 class="step_ttl">旅人をフォローして体験を共有する</h3>
            <p class="step_txt">好きな旅人を見つけたらどんどんフォローしましょう。フォローした人の投稿はタイムラインでいち早くチェック。次の旅の参考になるかもしれません。</p>
            <div class="img_area img_area_2">
              <img src="{{ asset('img/about_2.svg') }}" alt="">
            </div>
          </div>

          <div class="step_box">
            <p class="step_num">Step 3</p>
            <h3 class="step_ttl">ハプニングや気になった情報を投稿する</h3>
            <p class="step_txt">旅先でのふれあいや感動の記録、現地のお役立ち情報、ガイドブックに載らないようなアングラ情報や危険情報など、あなたが地球のレポーターです。</p>
            <div class="img_area img_area_3">
              <img src="{{ asset('img/about_3.svg') }}" alt="">
            </div>
          </div>

          <div class="new_btn">
            <a href="/register/create" class="bottom_hover">新規会員登録</a>
          </div>

          <div class="attention">
            ※一部の機能は当サイト会員のみのご利用となっております。<br>※会員登録は無料です。
          </div>
        </div>
      </div>
    </div>
    <div id="post_side_menu" class="pc">
    @include('components.post_side_menu')
    </div>
  </div>

  @include('components.footer')
</body>
</html>
