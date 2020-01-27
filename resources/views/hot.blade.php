@include('components.header')
<link href="{{ asset('css/hot.css') }}" rel="stylesheet">

</head>

<body id="hot">
  @include('components.menu')


  <div class="post_content">
    <div class="inner">
      
      <div id="post_list">

        <h2 class="ttl">Hot!! - {{ __('hot.featured_month') }} -</h2>

        @if($posts != '')
          @include('components.posts')
        @else
          <p style="text-align:center;padding:60px 0 100px;">{{ __('ranking.no_data') }}</p>
        @endif

      </div>
      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>
  </div>

  @include('components.footer')
</body>
</html>
