@include('components.header')
<link href="{{ asset('css/follow.css') }}" rel="stylesheet">
<link href="{{ asset('css/notice.css') }}" rel="stylesheet">

</head>

<body id="news" class="news">
  @include('components.menu')

  <div class="post_content">
    <div class="inner">
      <div id="news_box">
        <h1 class="news_ttl">{{ $news->title }}</h1>
        <p class="news_day">{{ $news->updated_at->format('Y/m/d') }}</p>
        <div class="news_cont">
          {!! $news->contents !!}
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
