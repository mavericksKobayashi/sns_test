@include('components.header')
<link href="{{ asset('css/follow.css') }}" rel="stylesheet">
<script src="{{ asset('js/follow.js') }}" defer></script>

</head>

<body id="follow" class="follow">
  @include('components.menu')

  <p id="view_id">{{$view_id}}</p>

  <div class="cont">

    @if ($page != 'register_follow')
    <div class="tab">

      @if ($page == 'follow')

      <div class="follow">
        <p>{{ __('user.user_follow') }}</p>
      </div>
      <div class="follower">
        <p><a href="/user_follower/{{$view_id}}">{{ __('user.user_follower') }}</a></p>
      </div>

      @elseif ($page == 'follower')

      <div class="follow">
        <p><a href="/user_follow/{{$view_id}}">{{ __('user.user_follow') }}</a></p>
      </div>
      <div class="follower">
        <p>{{ __('user.user_follower') }}</p>
      </div>

      @endif

    </div>
    @endif



    @if ($page == 'follow' || $page == 'register_follow')

    <form name="followForm" id="followForm" accept-charset="utf-8" method="post">
    {{ csrf_field() }}

      <ul class="follow">

        @if ($page != 'register_follow')
        <!-- 登録後のフォロー一覧 -->


          @if (isset($follows[0]))
          @foreach ($follows as $follow)

            @if (isset($follow->follow_users))

            <li class="user_follow">
              @if ($follow->follow_users->freeze == 1)
              <!-- 凍結アカウント -->
              <div class="user">
                <a href="javascript:void(0);">
                  <div class="user_icon">
                    <div class="img">
                      @php $thumb_path = 'uploads/'.$follow->follow_users->id.'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                      @endif
                    </div>
                    <div class="text">
                      <p class="my_user_id">{{$follow->follow_users->id}}</p>
                      <p class="user_name">{{$follow->follow_users->nickname}}</p>
                      <p class="user_place">凍結アカウント</p>
                    </div>
                  </div>
                </a>
              </div>
              @else
              <div class="user">
                <a href="/user/{{$follow->follow_users->id}}">
                  <div class="user_icon">
                    <div class="img">
                      @php $thumb_path = 'uploads/'.$follow->follow_users->id.'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                      @endif
                    </div>
                    <div class="text">
                      <p class="my_user_id">{{$follow->follow_users->id}}</p>
                      <p class="user_name">{{$follow->follow_users->nickname}}</p>
                      <p class="user_place">{{$follow->follow_users->place}}</p>
                    </div>
                  </div>
                </a>
              </div>
              @endif
              @php
                $followed = false;
                foreach ($my_follows as $my_follow){
                  if($follow->follow_users->id == $my_follow->follow_id){
                    $followed = true;
                    break;
                  }
                }
              @endphp

              @if($user->id != $follow->follow_users->id)
                @if($followed)
                <a href="javascript:void(0);" class="follow_btn active user">{{ __('user.user_following') }}</a>
                @else
                <a href="javascript:void(0);" class="follow_btn inactive user">{{ __('user.user_doFollow') }}</a>
                @endif
              @endif


            </li>

            @endif

          @endforeach
          @else
            <li class="no_hit">{{ __('user.user_no_follow') }}</li>
          @endif


        @else
        <!-- 登録前のオススメ -->


          @if (isset($users[0]))
          @foreach ($users as $user)

            <li class="user_follow">
              <div class="user">
                <div class="user_icon">
                  <div class="img">
                    @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
                    @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                    @else
                    <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                    @endif
                  </div>
                  <div class="text">
                    <p class="my_user_id">{{$user->id}}</p>
                    <p class="user_name">{{$user->nickname}}</p>
                    <p class="user_place">{{$user->place}}</p>
                  </div>
                </div>
              </div>

              @php $followed = false; @endphp
              @foreach ($my_follows as $my_follow)
                @if($user->id == $my_follow->follow_id)
                  @php
                    $followed = true;
                    break;
                  @endphp
                @endif
              @endforeach

              @if($followed)
              <a href="javascript:void(0);" class="follow_btn active osusume">{{ __('user.user_following') }}</a>
              @else
              <a href="javascript:void(0);" class="follow_btn inactive osusume">{{ __('user.user_doFollow') }}</a>
              @endif

            </li>

          @endforeach
          @else
            <li class="no_hit">{{ __('user.user_no_registered') }}</li>
          @endif


        @endif

      </ul>

    </form>


    @else


    <!-- フォロワー一覧 -->
    <form name="followForm" id="followForm" accept-charset="utf-8" method="post">
    {{ csrf_field() }}

      <ul class="follower">

        @if (isset($followers[0]))
          @foreach ($followers as $follower)

            @if (isset($follower->follower_users))

            <li class="user_follow">
              @if ($follower->follower_users->freeze == 1)
              <!-- 凍結アカウント -->
              <div class="user">
                <a href="javascript:void(0);">
                  <div class="user_icon">
                    <div class="img">
                      @php $thumb_path = 'uploads/'.$follower->follower_users->id.'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                      @endif
                    </div>
                    <div class="text">
                      <p class="my_user_id">{{$follower->follower_users->id}}</p>
                      <p class="user_name">{{$follower->follower_users->nickname}}</p>
                      <p class="user_place">凍結アカウント</p>
                    </div>
                  </div>
                </a>
              </div>
              @else
              <div class="user">
                <a href="/user/{{$follower->follower_users->id}}">
                  <div class="user_icon">
                    <div class="img">
                      @php $thumb_path = 'uploads/'.$follower->follower_users->id.'/user_profile.jpg'; @endphp
                      @if(File::exists($thumb_path))
                      <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                      @else
                      <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                      @endif
                    </div>
                    <div class="text">
                      <p class="my_user_id">{{$follower->follower_users->id}}</p>
                      <p class="user_name">{{$follower->follower_users->nickname}}</p>
                      <p class="user_place">{{$follower->follower_users->place}}</p>
                    </div>
                  </div>
                </a>
              </div>
              @endif
              @php
                $followed = false;
                foreach ($my_follows as $my_follow){
                  if($follower->follower_users->id == $my_follow->follow_id){
                    $followed = true;
                    break;
                  }
                }
              @endphp

              @if($user->id != $follower->follower_users->id)
                @if($followed)
                <a href="javascript:void(0);" class="follow_btn active">{{ __('user.user_following') }}</a>
                @else
                <a href="javascript:void(0);" class="follow_btn inactive">{{ __('user.user_doFollow') }}</a>
                @endif
              @endif

            </li>

            @endif

          @endforeach
          @else
            <li class="no_hit">{{ __('user.user_no_follower') }}</li>
          @endif
      </ul>
    </form>


    @endif


    @if ($page == 'register_follow')
    <a href="/login" class="common_btn">{{ __('user.user_start') }}</a>
    @endif

  </div>


  @include('components.footer')
</body>
</html>
