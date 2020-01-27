@include('components.header')
<link href="{{ asset('css/search.css') }}" rel="stylesheet">

</head>

<body id="search">
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
        <li class="active"><a href="/search">{{ __('create.search') }}</a></li>
      </ul>
    </div>
  </div>

  <div class="search_box">
    <div class="inner">
      <form class="" action="{{url('search')}}">
        @if (isset($keyword))
        <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
        @else
        <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
        @endif
      </form>
      <p><span class="count"></span>{{ __('search.search_results') }}</p>
    </div>
  </div>
  @if (1 == 0)
  <!-- <div class="search_tab">
    <div class="inner">
      <ul>
        <li class="active"><a href="">{{ __('search.post') }}</a></li>
        <li><a href="">{{ __('search.user') }}</a></li>
      </ul>
      <p class="serach_num"></p>
    </div>
  </div> -->
  @endif
  <div class="post_content">
    <div class="inner">
      <div id="post_list">
        @include('components.posts')
      </div>
      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>
  </div>

  @include('components.footer')
</body>
<script>
$(function() {
  var counter = 0;
  $('#post_list li').each(function(){
      counter++;
  });
  $('.count').text(counter);
});
</script>
</html>
