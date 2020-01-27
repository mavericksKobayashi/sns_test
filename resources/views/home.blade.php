@include('components.header')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

</head>

<body id="home">
  @include('components.menu')

  <!-- フラッシュメッセージ -->
  @if (session('flash_message'))
      <div class="flash_message flash_message_success">
          <p>{{ session('flash_message') }}</p>
      </div>
  @endif
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
        @if($tab == 'フォロワー')
        <li class="active"><a href="/home">{{ __('home.followers') }}</a></li>
        @elseif($tab == 'Followers')
        <li class="active"><a href="/home">{{ __('home.followers') }}</a></li>
        @else
        <li><a href="/home">{{ __('home.followers') }}</a></li>
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

      <div id="post_list">

        <h2 class="ttl">{{$tab}}</h2>

        @include('components.posts')

      </div>
      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>
  </div>

  @include('components.footer')
</body>
</html>
