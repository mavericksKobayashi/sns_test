@include('components.header')
<link href="{{ asset('css/top.css') }}" rel="stylesheet">
<link href="{{ asset('css/accordion.css') }}" rel="stylesheet">

</head>


<body id="top" class="top_page">
  @include('components.menu')
  <div class="mv">
    <div class="slid_view">
      <img src="{{ asset('img/mv_1_sp.jpg') }}" alt="" class="switch object-fit">
      <img src="{{ asset('img/mv_2_sp.jpg') }}" alt="" class="switch object-fit">
      <img src="{{ asset('img/mv_3_sp.jpg') }}" alt="" class="switch object-fit">
      <img src="{{ asset('img/mv_4_sp.jpg') }}" alt="" class="switch object-fit">
    </div>
    <div class="mv_text">
      <div>
        <h2 id="mv_ttl" class="ttl">Discover the world!<span class="jp_txt">
          {{ __('top.mv_ttl') }}
        </span></h2>
        <div class="top_menu">
          <a href="register/create" class="common_btn bottom_hover">{{ __('top.mv_get_started_now') }}</a>
          <a href="about" class="common_btn bottom_hover">{{ __('top.mv_about') }}</a>
        </div>
      </div>
    </div>
    <a class="sp scroll_anime" href="#main_wrap">
      <p>DEPARTURE</p>
    </a>
  </div>

  <div class="post_content">
    <div class="inner">

      <div class="top_search sp">
        <form class="" action="{{url('search')}}">
          <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
        </form>
      </div>

      <div id="main_wrap">

        <div class="special_collection">
          <div class="special_collection_ttl">
            <p>おすすめ特集</p>
            <a href="#">特集一覧</a>
          </div>
          <div class="special_collection_cont">
            <a href="#">
              <img src="{{ asset('img/special_collection_1.png') }}" alt="絶叫！！　ホラー大特集">
            </a>
            <a href="#">
              <img src="{{ asset('img/special_collection_2.png') }}" alt="3万円から　ハワイ旅行！？">
            </a>
          </div>
        </div>

        <div class="various_rankings">
          <div class="various_rankings_tab">
            <p class="recommended_best active">おすすめ</p>
            <p class="ranking_best_w">週間</p>
            <p class="ranking_best_m">月間</p>
            <p class="topic_best">話題</p>
          </div>
          <div class="various_rankings_best5">
            <ul class="recommended_best various_ranking_list active">
              <li class="pc">
                <img src="{{ asset('img/recommend_banner_top.png') }}" alt="おすすめ">
              </li>
              @if(!empty($recommend[0]))
              @foreach($recommend as $reco)
              <li>
                @php
                  // サムネイル
                  if($reco[7]){
                    $extension = 'jpg';
                    if($reco[9] == 'image/png'){
                      $extension = 'png';
                    }
                    $thumb_path = 'uploads/'.$reco[2].'/post_'.$reco[1].'_'.$reco[8].'_thumb.'.$extension;
                  } else {
                    // データベースに画像データがない
                    $thumb_path = 'img/no_image_post.png';
                  }
                @endphp
                <a href="/post/{{$reco[1]}}" style="background-image: url({{ asset($thumb_path) }})">
                  <p class="ranking_num">
                    <img src="{{ asset('img/icon_recommend.png') }}" alt="{{$reco[0]}}位">
                  </p>
                  <div class="overlay"></div>
                  <div class="inner">
                    <div class="user_info">
                      @php $thumb_path = 'uploads/'.$reco[2].'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                      @endif
                      <p class="name">{{$reco[3]}}</p>
                    </div>
                    <p class="day">{{$reco[4]}}</p>
                    <p class="place"><span>#</span>{{$reco[5]}}</p>
                    <p class="like_count">{{$reco[6]}}</p>
                  </div>
                </a>
              </li>
              @endforeach
              <li class="page_link">
                <a href="/recommend">
                  <p>おすすめをもっとみる</p>
                </a>
              </li>
              @else
              <li>ランキングがありません</li>
              @endif
            </ul>
            <ul class="ranking_best_w various_ranking_list">
              <li class="pc">
                <img src="{{ asset('img/week_banner_top.png') }}" alt="週間">
              </li>
              @if(!empty($ranking_w[0]))
              @foreach($ranking_w as $w)
              <li>
                @php
                  // サムネイル
                  if($w[7]){
                    $extension = 'jpg';
                    if($w[9] == 'image/png'){
                      $extension = 'png';
                    }
                    $thumb_path = 'uploads/'.$w[2].'/post_'.$w[1].'_'.$w[8].'_thumb.'.$extension;
                  } else {
                    // データベースに画像データがない
                    $thumb_path = 'img/no_image_post.png';
                  }
                @endphp
                <a href="/post/{{$w[1]}}" style="background-image: url({{ asset($thumb_path) }})">
                  <p class="ranking_num ranking_num_{{$w[0]}}">
                    <img src="{{ asset('img/ranking_num_'.$w[0].'.png') }}" alt="{{$w[0]}}位">
                  </p>
                  <div class="overlay"></div>
                  <div class="inner">
                    <div class="user_info">
                      @php $thumb_path = 'uploads/'.$w[2].'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                      @endif
                      <p class="name">{{$w[3]}}</p>
                    </div>
                    <p class="day">{{$w[4]}}</p>
                    <p class="place"><span>#</span>{{$w[5]}}</p>
                    <p class="like_count">{{$w[6]}}</p>
                  </div>
                </a>
              </li>
              @endforeach
              <li class="page_link">
                <a href="/ranking_w">
                  <p>週間ランキングをもっとみる</p>
                </a>
              </li>
              @else
              <li>ランキングがありません</li>
              @endif
            </ul>
            <ul class="ranking_best_m various_ranking_list">
              <li class="pc">
                <img src="{{ asset('img/month_banner_top.png') }}" alt="月間">
              </li>
              @if(!empty($ranking_m[0]))
              @foreach($ranking_m as $m)
              <li>
                @php
                  // サムネイル
                  if($m[7]){
                    $extension = 'jpg';
                    if($m[9] == 'image/png'){
                      $extension = 'png';
                    }
                    $thumb_path = 'uploads/'.$m[2].'/post_'.$m[1].'_'.$m[8].'_thumb.'.$extension;
                  } else {
                    // データベースに画像データがない
                    $thumb_path = 'img/no_image_post.png';
                  }
                @endphp
                <a href="/post/{{$m[1]}}" style="background-image: url({{ asset($thumb_path) }})">
                  <p class="ranking_num ranking_num_{{$m[0]}}">
                    <img src="{{ asset('img/ranking_num_'.$m[0].'.png') }}" alt="{{$m[0]}}位">
                  </p>
                  <div class="overlay"></div>
                  <div class="inner">
                    <div class="user_info">
                      @php $thumb_path = 'uploads/'.$m[2].'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                      @endif
                      <p class="name">{{$m[3]}}</p>
                    </div>
                    <p class="day">{{$m[4]}}</p>
                    <p class="place"><span>#</span>{{$m[5]}}</p>
                    <p class="like_count">{{$m[6]}}</p>
                  </div>
                </a>
              </li>
              @endforeach
              <li class="page_link">
                <a href="/ranking_m">
                  <p>月間ランキングをもっとみる</p>
                </a>
              </li>
              @else
              <li>ランキングがありません</li>
              @endif
            </ul>
            <ul class="topic_best various_ranking_list">
              <li class="pc">
                <img src="{{ asset('img/topic_banner_top.png') }}" alt="話題">
              </li>
              @if(!empty($ranking_y[0]))
              @foreach($ranking_y as $y)
              <li>
                @php
                  // サムネイル
                  if($y[7]){
                    $extension = 'jpg';
                    if($y[9] == 'image/png'){
                      $extension = 'png';
                    }
                    $thumb_path = 'uploads/'.$y[2].'/post_'.$y[1].'_'.$y[8].'_thumb.'.$extension;
                  } else {
                    // データベースに画像データがない
                    $thumb_path = 'img/no_image_post.png';
                  }
                @endphp
                <a href="/post/{{$y[1]}}" style="background-image: url({{ asset($thumb_path) }})">
                  <p class="ranking_num">
                    <img src="{{ asset('img/icon_topic.png') }}" alt="{{$y[0]}}位">
                  </p>
                  <div class="overlay"></div>
                  <div class="inner">
                    <div class="user_info">
                      @php $thumb_path = 'uploads/'.$y[2].'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                      @endif
                      <p class="name">{{$y[3]}}</p>
                    </div>
                    <p class="day">{{$y[4]}}</p>
                    <p class="place"><span>#</span>{{$y[5]}}</p>
                    <p class="like_count">{{$y[6]}}</p>
                  </div>
                </a>
              </li>
              @endforeach
              <li class="page_link">
                <a href="/topic">
                  <p>話題をもっとみる</p>
                </a>
              </li>
              @else
              <li>ランキングがありません</li>
              @endif
            </ul>
          </div>
        </div>

        <div class="post_bg">
          <div class="contain post">
            <h3 class="ttl">
              <span>{{ __('top.new_post') }}</span>
            </h3>
            @include('components.posts')
          </div>
        </div>

        <div id="accordion" class="contain category">
          <h3 class="ttl">
            {{ __('top.Categories') }}
          </h3>

          <h4 class="sub pc"><a href="/category/国内旅行">
            {{ __('top.Domestic_travel') }}
          </a></h4>

          <h4 class="sub sp accordion_ttl">
            {{ __('top.Domestic_travel') }}
          </h4>
          <ul>
            <li class="sp"><a href="/category/国内旅行">{{ __('top.Domestic_travel') }}</a></li>
            @foreach($domestic_categories as $d_cat)
            @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
                @if ($lang == 'ja' )
                <li><a href="/category/{{$d_cat->name}}">{{$d_cat->name_en}}</a></li>
                @else
                <li><a href="/category/{{$d_cat->name}}">{{$d_cat->name}}</a></li>
                @endif
              @endif
            @endforeach
            @endforeach
          </ul>

          <h4 class="sub pc"><a href="/category/海外旅行">
            {{ __('top.Overseas_trip') }}
          </a></h4>

          <h4 class="sub sp accordion_ttl">
            {{ __('top.Overseas_trip') }}
          </h4>
          <ul>
            <li class="sp"><a href="/category/海外旅行">{{ __('top.Overseas_trip') }}</a></li>
            @foreach($overseas_categories as $o_cat)
            @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
                @if ($lang == 'ja' )
                <li><a href="/category/{{$o_cat->name}}">{{$o_cat->name_en}}</a></li>
                @else
                <li><a href="/category/{{$o_cat->name}}">{{$o_cat->name}}</a></li>
                @endif
              @endif
            @endforeach
            @endforeach
          </ul>

        </div>

      </div>

      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>
  </div>

  <section id="intro">
    <div class="box">
      <div class="cont">
        <h1><span>#</span><span>旅するSNS</span><br><img src="{{ asset('img/logo.svg') }}" alt="FLIP"></h1>
        <p class="text">
          {{ __('top.intro_text') }}
        </p>
        <a href="javascript:void(0)" class="common_btn">
          {{ __('top.intro_find') }}
        </a>
        <a href="/register/create">
          {{ __('top.intro_account') }}
        </a>
      </div>
    </div>
  </section>

  <section id="language">
    <div class="box">
      <div class="cont">
        <h1><span class="lang_jp">#</span><span class="lang_jp">旅するSNS</span><br><img src="{{ asset('img/logo.svg') }}" alt="FLIP"></h1>
        <p>言語選択<span>Language Choice</span></p>

    <a href="javascript:void(0);" class="common_btn">
        {{ Config::get('languages')[App::getLocale()] }}
    </a>

        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())

            <a href="javascript:void(0);" data-lang="{{ route('lang.switch', $lang) }}" class="common_btn">{{$language}}</a>
            @endif
        @endforeach

      </div>


    </div>
  </section>


  @include('components.footer')
  <script>
  $(function(){
    var height = $(window).height() - 50;
    var windowheight = $(window).height();
    var windowWidth = $(window).width();
    if (windowWidth < 751){
      $('.mv').css('height',height);
      $('.slide').css('height',height);
      $('.slid_view').css('height',height);
      $('.slid_view img').css('height',height);
      $('.slide img').css('height',height);
      $('#intro').css('height',windowheight);
    }
  });

  $(function(){
    $('.various_rankings_tab p').click(function(){
      $('.various_rankings_tab p').removeClass('active');
      $('.various_ranking_list').removeClass('active');
      $active_class = $(this).attr('class');
      $('.' + $active_class).addClass('active');
    });
  });
  </script>
</body>
</html>
