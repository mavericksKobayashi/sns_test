@include('components.header')
<link href="{{ asset('css/user-mypage.css') }}" rel="stylesheet">
<script src="{{ asset('js/follow.js') }}" defer></script>

</head>

<body id="my_page">
  @include('components.menu')
  <p id="view_id" class="disp_non">{{$view_id}}</p>

  <div class="post_content">
    <div class="inner">
      <div class="mypage_wrap">
        <div class="mypage_profile_area">
          <div class="mypage_profile">

            <div class="mypage_profile_personal">
              <p class="mypage_profile_img">

                @if($myself)
                <a href="/home">
                @endif

                @php $thumb_path = 'uploads/'.$view_id.'/user_profile.jpg'; @endphp
                @if(File::exists($thumb_path))
                <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                @else
                <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                @endif

                @if($myself)
                </a>
                @endif

              </p>

              @if($locked_status == 1)
              <p id="locked"><img src="{{ asset('img/locked.svg')}}" alt="locked"></p>
              @endif

            </div>

            <div class="mypage_profile_status">
              <p class="mypage_profile_follow">
                <a href="/user_follow/{{$view_id}}">
                  <span class="mypage_profile_follow_num mypage_profile_status_num">{{$follows_count}}</span>
                  <span class="mypage_profile_follow_txt mypage_profile_status_txt">{{ __('user.user_follow') }}</span>
                </a>
              </p>
              <p class="mypage_profile_follower">
                <a href="/user_follower/{{$view_id}}">
                  <span class="mypage_profile_follower_num mypage_profile_status_num">{{$followers_count}}</span>
                  <span class="mypage_profile_follower_txt mypage_profile_status_txt">{{ __('user.user_follower') }}</span>
                </a>
              </p>
              <p class="mypage_profile_bookmark">

                  <span class="mypage_profile_bookmark_num mypage_profile_status_num">{{$bookmark_count}}</span>
                  <span class="mypage_profile_bookmark_txt mypage_profile_status_txt">{{ __('user.user_bookmarks') }}</span>

              </p>
            </div>
          </div>
          <div class="profile_edit">
            <p class="mypage_profile_name">{{$view_user->nickname}}</p>
            <div id="user_btn_area" class="user_btn_area">
            @if($myself)
              <a href="/user_edit/" class="bottom_hover">{{ __('user.user_toEdit') }}</a>
            @else
              @php
                $followed = false;
                foreach ($my_follows as $my_follow){

                  if($view_id == $my_follow->follow_id){
                    $followed = true;
                    break;
                  }
                }
              @endphp
                <form name="followForm" id="followForm" accept-charset="utf-8" method="post">
                {{ csrf_field() }}
                <div id="follow">
                @if($followed)
                  <a href="javascript:void(0);" class="follow_btn active user_page">{{ __('user.user_following') }}</a>
                @else
                  <a href="javascript:void(0);" class="follow_btn inactive user_page">{{ __('user.user_doFollow') }}</a>
                @endif
              </div>
              </form>
              @if($user->block)
              @else
              <a href="/user_message/{{$view_id}}" class="message_link_btn">{{ __('user.user_message') }}</a>
              @endif
            @endif
            </div>
          </div>
          <p class="mypage_profile_about">{{$view_user->self_intro}}</p>
        </div>



        <div id="post_list">

          @include('components.posts')

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
