@include('components.header')
<link href="{{ asset('css/ranking.css') }}" rel="stylesheet">

</head>

<body id="ranking">
  @include('components.menu')

  <div class="ranking_tab">
    <div class="inner">
      @foreach (Config::get('languages') as $lang => $language)
        @if ($lang != App::getLocale())
          @if ($lang == 'ja' )
          <ul class="en">
          @else
          <ul>
          @endif
        @endif
      @endforeach
        @if(isset($user))
        @if($tab == 'フォロワー')
        <li class="active"><a href="/home">{{ __('home.followers') }}</a></li>
        @elseif($tab == 'Followers')
        <li class="active"><a href="/home">{{ __('home.followers') }}</a></li>
        @else
        <li><a href="/home">{{ __('home.followers') }}</a></li>
        @endif
        @endif

        @if($tab == 'recommend')
        <li class="active"><a href="/recommend">{{ __('home.recommended') }}</a></li>
        @else
        <li><a href="/recommend">{{ __('home.recommended') }}</a></li>
        @endif

        @if($tab == 'week')
        <li class="active"><a href="/ranking_w">{{ __('ranking.weekly') }}</a></li>
        @else
        <li><a href="/ranking_w">{{ __('ranking.weekly') }}</a></li>
        @endif

        @if($tab == 'month')
        <li class="active"><a href="/ranking_m">{{ __('ranking.monthly') }}</a></li>
        @else
        <li><a href="/ranking_m">{{ __('ranking.monthly') }}</a></li>
        @endif

        @if($tab == 'topic')
        <li class="active"><a href="/topic">{{ __('home.topic') }}</a></li>
        @else
        <li><a href="/topic">{{ __('home.topic') }}</a></li>
        @endif
        <li><a href="/search">{{ __('create.search') }}</a></li>
      </ul>
    </div>
  </div>


  <div class="post_content">
    <div class="inner">
      <div id="main_wrap">
        <div class="various_rankings_area">
          <div class="various_rankings_tab pc">
            @if($tab == 'recommend')
            <a href="/recommend" class="recommended_best active">おすすめ</a>
            @else
            <a href="/recommend" class="recommended_best">おすすめ</a>
            @endif
            @if($tab == 'week')
            <a href="/ranking_w" class="ranking_best_w active">週間</a>
            @else
            <a href="/ranking_w" class="ranking_best_w">週間</a>
            @endif
            @if($tab == 'month')
            <a href="/ranking_m" class="ranking_best_m active">月間</a>
            @else
            <a href="/ranking_m" class="ranking_best_m">月間</a>
            @endif
            @if($tab == 'topic')
            <a href="/topic" class="topic_best active">話題</a>
            @else
            <a href="/topic" class="topic_best">話題</a>
            @endif
          </div>
          <div class="banner_various_rankings">
            <div class="banner">
              <img src="{{ asset('img/'. $tab .'_banner_sp.png') }}" alt="" class="switch">
            </div>
            <div class="various_rankings_best5">
              <ul class="various_ranking_list active">
                @if(!empty($lists[0]))
                @foreach($lists as $list)
                <li>
                  @php
                    // サムネイル
                    if($list[7]){
                      $extension = 'jpg';
                      if($list[9] == 'image/png'){
                        $extension = 'png';
                      }
                      $thumb_path = 'uploads/'.$list[2].'/post_'.$list[1].'_'.$list[8].'_thumb.'.$extension;
                    } else {
                      // データベースに画像データがない
                      $thumb_path = 'img/no_image_post.png';
                    }
                  @endphp
                  <a href="/post/{{$list[1]}}" style="background-image: url({{ asset($thumb_path) }})">
                    @if($tab == 'recommend')
                    <p class="ranking_num ranking_recommend">
                      <img src="{{ asset('img/icon_recommend.png') }}" alt="{{$list[0]}}位">
                    </p>
                    @elseif($tab == 'topic')
                    <p class="ranking_num ranking_topic">
                      <img src="{{ asset('img/icon_topic.png') }}" alt="{{$list[0]}}位">
                    </p>
                    @else
                    <p class="ranking_num ranking_num_{{$list[0]}}">
                      <img src="{{ asset('img/ranking_num_'.$list[0].'.png') }}" alt="{{$list[0]}}位">
                    </p>
                    @endif
                    <div class="overlay"></div>
                    <div class="inner">
                      <div class="user_info">
                        @php $thumb_path = 'uploads/'.$list[2].'/user_profile.jpg'; @endphp
                        @if(File::exists($thumb_path))
                        <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                        @else
                        <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                        @endif
                        <p class="name">{{$list[3]}}</p>
                      </div>
                      <p class="day">{{$list[4]}}</p>
                      <p class="place"><span>#</span>{{$list[5]}}</p>
                      <p class="like_count">{{$list[6]}}</p>
                    </div>
                  </a>
                </li>
                @endforeach
                @else
                <li>ランキングがありません</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>
  </div>

  @include('components.footer')
</body>
</html>
