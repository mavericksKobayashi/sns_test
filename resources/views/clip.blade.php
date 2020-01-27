@include('components.header')
<link href="{{ asset('css/single_list.css') }}" rel="stylesheet">

</head>

<body id="clip" class="single_list">
  @include('components.menu')

  <div class="clip_tab">
    <div class="inner">
      <h2 class="ttl">{{ __('clip.bookmarks') }}</h2>
      <!--<ul>
        <li class="active"><a href="">{{ __('clip.posts') }}</a></li>
      </ul>-->
    </div>
  </div>

  <div class="post_content">
    <div class="inner">
      <div class="other_content">

        @isset($no_post)
          @if(!$no_post)
            @include('components.list')
          @else
            <p class="no_post">{{ __('clip.no_bookmarks') }}</p>
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
