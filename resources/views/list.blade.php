@include('components.header')
<link href="{{ asset('css/single_list.css') }}" rel="stylesheet">

</head>

<body id="clip" class="single_list">
  @include('components.menu')

  <div class="clip_tab">
    <div class="inner">
      @foreach (Config::get('languages') as $lang => $language)
        @if ($lang != App::getLocale())
          @if ($lang == 'ja' )
          <h2 class="ttl">{{$page_name_en}} > {{$category_name_en}}</h2>
          @else
          <h2 class="ttl">{{$page_name}} > {{$list_name}}</h2>
          @endif
        @endif
      @endforeach
    </div>
  </div>

  <div class="post_content">
    <div class="inner">
      <div class="other_content">
        @isset($no_post)
          @if(!$no_post)
            @include('components.list')
          @else
            <p class="no_post">{{ __('list.no_post_yet') }}</p>
          @endisset
        @else
          @include('components.list')
        @endisset
      </div>
      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>
  </div>

  @include('components.footer')
</body>
</html>
