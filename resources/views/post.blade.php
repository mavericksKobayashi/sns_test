@include('components.header')
<link href="{{ asset('css/post.css') }}" rel="stylesheet">
<script src="{{ asset('js/post.js') }}" defer></script>

</head>

@if (isset( $user ))
<body id="post" class="logined">
@else
<body id="post">
@endif

  <div id="post_id" class="disp_non">{{$post->id}}</div>
  <div id="post_user" class="disp_non">{{$post_user->id}}</div>

  @if($my_post)
  <div id="my_post" class="disp_non"></div>
  @endif

  @isset($scr_pos)
  <div id="scr_pos" class="disp_non">{{$scr_pos}}</div>
  @endisset

  @include('components.menu')



  <div class="breadcrumb">
    <div class="inner">
      <a href="javascript:void(0);">{{$post->place}}</a>
    </div>
  </div>
  <div class="post_content">
    <div class="inner">

      <div class="main">

        @if(!$my_publish)
        <div class="my_publish">
          <p>{{ __('post.marked_private') }}<br><a href="/publish/{{$post->id}}">- {{ __('post.publish_now') }}</a></p>
        </div>
        @endif

        @if($my_post)
        <div class="my_post">
          <p><a href="/edit/{{$post->id}}">{{ __('post.to_edit') }}</a></p>
        </div>
        @endif


        @if(!empty($mains[0]))
        <div class="post_img">
          <div class="post_slide">

            @foreach($mains as $main)

              @php
                $order_num = $main->order_num;
                $extension = 'jpg';
                if($main->type == 'image/png'){
                  $extension = 'png';
                }
                $thumb_path = 'uploads/'.$post->user_id.'/post_'.$post->id.'_'.$order_num.'.'.$extension;
              @endphp

              @if(File::exists($thumb_path))
                <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
              @else
                <img src="{{ asset('img/no_image_post.png') }}" class="object-fit">
              @endif

            @endforeach

          </div>

          @if($my_booked < 1 && isset( $user ) && !$my_post)
          <div class="post_bookmark sp">
            <a href="/add_bookmark/{{$post->id}}">
              <img src="{{ asset('img/post_bookmark.svg') }}" alt="{{ __('post.do_bookmark') }}">
            </a>
          </div>
          @endif
        </div>

        @else
          <div style="height:30px" class="sp"></div>
        @endif

        <div class="text_area">

          <div class="textarea_top">
            <div class="user_icon pc">

              <a href="/user/{{$post_user->id}}" class="icon">
                @php $thumb_path = 'uploads/'.$post_user->id.'/user_profile.jpg'; @endphp
                @if(File::exists($thumb_path))
                <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                @else
                <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                @endif

                @if(isset($locked_status) && $locked_status == 1)
                <p class="locked"><img src="{{ asset('img/locked.svg')}}" alt="locked"></p>
                @endif
              </a>

              <a href="/user/{{$post_user->id}}">
              <p class="name">{{$post_user->nickname}}</p>
              </a>
            </div>

            <div class="rating">
              @if($post->rating == 1)
                <p>1.0</p>
                <img src="{{ asset('img/rating_1.svg') }}" alt="{{ __('post.evaluation') }} 1">
              @elseif($post->rating == 2)
                <p>2.0</p>
                <img src="{{ asset('img/rating_1.svg') }}" alt="{{ __('post.evaluation') }} 2">
              @elseif($post->rating == 3)
                <p>3.0</p>
                <img src="{{ asset('img/rating_3.svg') }}" alt="{{ __('post.evaluation') }} 3">
              @elseif($post->rating == 4)
                <p>4.0</p>
                <img src="{{ asset('img/rating_3.svg') }}" alt="{{ __('post.evaluation') }} 4">
              @elseif($post->rating == 5)
                <p>5.0</p>
                <img src="{{ asset('img/rating_3.svg') }}" alt="{{ __('post.evaluation') }} 5">
              @else
                <!--<p style="font-weight:normal;font-size:11px;">{{ __('post.no_rating') }}</p>-->
              @endif
            </div>
          </div>

          @if($post->date)
          <div class="date">
            @php
              $unix = $post->date;
              $date = date('Y.m.d', $unix);
            @endphp
            <p>{{ $date }} {{ __('post.visit') }}</p>
          </div>
          @endif

          <div class="text">
            <p>{!! nl2br($post->contents) !!}</p>
          </div>

          @if(isset($tags[0]))
          <div class="tags">
            @foreach($tags as $tag)
            <a href="/tag/{{$tag->name}}">#{{$tag->name}}</a>
            @endforeach
          </div>
          @endif

          @if($category_name != '')
          <div class="category">
            @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
                @if ($lang == 'ja' )
                <a href="/category/{{$category_name}}">{{$category_name_en}}</a>
                @else
                <a href="/category/{{$category_name}}">{{$category_name}}</a>
                @endif
              @endif
            @endforeach
          </div>
          @endif

          <div class="btn_area">

            @if($my_liked > 0)
            <div class="icon like active">
              <img src="{{ asset('img/icon_like_on.svg') }}" alt="{{ __('post.nice') }}">
            @else
            <div class="icon like">
              <img src="{{ asset('img/icon_like_off.svg') }}" alt="{{ __('post.nice') }}">
            @endif
              <p class="count">{{$liked}}</p>
            </div>

            @if($my_booked > 0)
            <div class="icon bookmark active">
              <img src="{{ asset('img/icon_bookmark_post_on.svg') }}" alt="{{ __('post.bookmark') }}">
            @else
            <div class="icon bookmark">
              <img src="{{ asset('img/icon_bookmark_post_off.svg') }}" alt="{{ __('post.bookmark') }}">
            @endif
              <p class="count">{{$bookmarked}}</p>
            </div>

          </div>
        </div>

        @if($place_lat)
        <div id="map_area">
          <div class="map_area">
            <div class="map_ttl">
              <p class="icon">
                <img src="{{ asset('img/icon_cafe.jpg') }}" alt="">
              </p>
              <p>{{$post->place}}</p>
            </div>
            <div id="gmap"></div>
          </div>
        </div>
        @endif


        <div class="border"></div>

        <div class="comment_area">
          <div class="comment_ttl">
            {{ __('post.comment') }}
          </div>

          @foreach($comments as $comment)

            @php
              $nickname = $comment->comment_users()->first()->nickname;
              if(is_null($comment->updated_at)){
                $date = '';
              } else {
                $date = $comment->updated_at->format('Y.n.j');
              }
            @endphp


            @if($post_user->id == $comment->user_id)

              <div class="contributor">
                <div class="comment_box">
                  <p class="name"><a href="/user/{{$comment->user_id}}">{{$nickname}}</a></p>
                  <p class="comment">{!! nl2br($comment->comment) !!}</p>
                  @if($date != '')
                  <p class="date">{{$date}}</p>
                  @endif
                </div>
                <div class="user_icon">
                  <a href="/user/{{$comment->user_id}}">
                  @php $thumb_path = 'uploads/'.$comment->user_id.'/user_profile.jpg'; @endphp
                  @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                  @else
                    <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                  @endif
                  </a>
                </div>
              </div>

            @else

              <div class="etcetera">
                <div class="user_icon">
                  <a href="/user/{{$comment->user_id}}">
                  @php $thumb_path = 'uploads/'.$comment->user_id.'/user_profile.jpg'; @endphp
                  @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                  @else
                    <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                  @endif
                  </a>
                </div>
                <div class="comment_box">
                  <p class="name"><a href="/user/{{$comment->user_id}}">{{$nickname}}</a></p>
                  <p class="comment">{!! nl2br($comment->comment) !!}</p>
                  @if($date != '')
                  <p class="date">{{$date}}</p>
                  @endif
                </div>
              </div>

            @endif
          @endforeach

        </div>


        <!-- コメント入力 -->
        @if (isset( $user ))
        <div class="comment_input">
          <form id="comment_form" name="comment_form">
            {{ csrf_field() }}
            <textarea type="textarea" name="comment" value="" placeholder="{{ __('post.enter_comment') }}"></textarea>
            <a href="javascript:void(0);" class="bottom_hover">{{ __('post.post_comment') }}</a>
          </form>
        </div>
        <script>
          $('#comment_form a').on('click',function(){
            if($('#comment_form textarea').val() != ''){
              var submitForm = $('#comment_form');
              var pos = document.documentElement.scrollTop || document.body.scrollTop;
              var actionURL = '/add_comment/{{$post->id}}/{{$user->id}}/'+pos;
              submitForm.attr('action', actionURL);
              submitForm.submit();
            }
          });
        </script>
        @endif


        @if (!empty( $sames[0]) && $place_lat )
        <div class="border"></div>

        <div class="reviews_area">
          <div id="post_list">
            <p class="ttl">{{ __('post.same_place') }}</p>
            <ul class="reviews_slide">

            @foreach($sames as $post)
              @php
                // サムネイル
                $post_images = $post->post_image()->first();
                if($post_images){
                  $order_num = $post_images->order_num;
                  $extension = 'jpg';
                  if($post_images->type == 'image/png'){
                    $extension = 'png';
                  }
                  $thumb_path = 'uploads/'.$post->user_id.'/post_'.$post->id.'_'.$order_num.'_thumb.'.$extension;
                } else {
                  // データベースに画像データがない
                  $thumb_path = 'img/no_image_post.png';
                }

                // カテゴリー
                $category_name_flag = false;
                if($post->category > 0){
                  $category_name_flag = true;
                  $category_name = $post->post_category()->first()->name;
                  $category_name_en = $post->post_category()->first()->name_en;
                }
              @endphp

              <li>
                <a href="/post/{{$post->id}}">
                  @if($category_name_flag)
                  @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                      @if ($lang == 'ja' )
                      <p class="post_tag">{{$category_name_en}}</p>
                      @else
                      <p class="post_tag">{{$category_name}}</p>
                      @endif
                    @endif
                  @endforeach
                  @endif

                  @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                  @else
                    <img src="{{ asset('img/no_image_post.png') }}" class="object-fit">
                  @endif

                </a>
              </li>
            @endforeach

            </ul>
          </div>
        </div>
        @endif


      </div>
      <div id="post_side_menu" class="pc">
      @include('components.post_side_menu')
      </div>
    </div>

  </div>

  @include('components.footer')


  <script>
    var map;
    var marker;
    var center = {
      lat: {{ $place_lat }},
      lng: {{ $place_lng }}
    };


    function initMap() {
      map = new google.maps.Map(document.getElementById('gmap'), {
        center: center,
        zoom: 15
      });
      marker = new google.maps.Marker({
        position: center,
        map: map,
        icon: {
          url: '/img/map_icon.png',
          scaledSize : new google.maps.Size(50, 50)
        }
      });
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54OWFXnwA-VKgHS1T28AZvcEs7nBh964&callback=initMap"></script>

</body>
</html>
