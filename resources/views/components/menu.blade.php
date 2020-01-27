<header id="header">
  @if(Request::is('post/*'))
  <div class="header_menu sp">

    <a href="javascript:history.back();" class="back"></a>
    <h1 class="user">

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
    </h1>

    @isset($user->id)
    <div class="header_btn_sp user_menu_btn"></div>
    @endisset

  </div>
  <div class="header_menu pc">
    <h1 class="logo">
      @if(Request::is('/'))
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      @else
      <a href="/home">
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      </a>
      @endif
    </h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="menu_search_box">
              <form class="" action="{{url('search')}}">
                @if (isset($keyword))
                <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
                @else
                <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
                @endif
              </form>
            </div>
          </li>
          <li>
            @if (isset( $user ))
            <a href="/create" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @else
            <a href="/login" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/ranking_w" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @else
            <a href="/login" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/bookmark" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @else
            <a href="/login" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @endif
          </li>
          <!-- <li>
            <a href="#" class="news text_hover">{{ __('components.menu_news') }}</a>
          </li>pc切り替え-->
        </ul>
      </div>
      <div class="header_btn">

        @if (isset( $user ))
          <!-- ログインしている -->

          @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
          @if(File::exists($thumb_path))
          <img src="{{ asset($thumb_path) }}" alt="" class="object-fit user_menu_btn">
          @else
          <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit user_menu_btn">
          @endif

        @else
          <!-- ログインしていない -->
          <a href="/login" class="bd_orange bottom_hover">{{ __('components.menu_login') }}</a>
          <a href="/register/create" class="bg_orange bottom_hover">{{ __('components.menu_member_registration') }}</a>
        @endif

      </div>
    </div>
  </div>
  @elseif(Request::is('user/*'))
  <div class="header_menu sp">
    <a href="javascript:history.back();" class="back"></a>
    <h1 class="user">
      <!--{{$user->flip_id}}-->
      <a href="javascript:history.back();">Return</a>
    </h1>
    <div class="header_btn_sp user_menu_btn">
    </div>
  </div>
  <div class="header_menu pc">
    <h1 class="logo">
      @if(Request::is('/'))
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      @else
      <a href="/home">
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      </a>
      @endif
    </h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="menu_search_box">
              <form class="" action="{{url('search')}}">
                @if (isset($keyword))
                <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
                @else
                <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
                @endif
              </form>
            </div>
          </li>
          <li>
            @if (isset( $user ))
            <a href="/create" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @else
            <a href="/login" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/ranking_w" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @else
            <a href="/login" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/bookmark" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @else
            <a href="/login" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @endif
          </li>
          <!-- <li>
            <a href="#" class="news text_hover">{{ __('components.menu_news') }}</a>
          </li>pc切り替え-->
        </ul>
      </div>
      <div class="header_btn">

        @if (isset( $user ))
          <!-- ログインしている -->

          @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
          @if(File::exists($thumb_path))
          <img src="{{ asset($thumb_path) }}" alt="" class="object-fit user_menu_btn">
          @else
          <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit user_menu_btn">
          @endif

        @else
          <!-- ログインしていない -->
          <a href="/login" class="bd_orange bottom_hover">{{ __('components.menu_login') }}</a>
          <a href="/register/create" class="bg_orange bottom_hover">{{ __('components.menu_member_registration') }}</a>
        @endif

      </div>
    </div>
  </div>
  @elseif(Request::is('notice'))
  <div class="header_menu sp">
    <a href="javascript:history.back();" class="back"></a>
    <h1 class="user">
      <!--{{$user->flip_id}}-->
      <a href="javascript:history.back();">通知</a>
    </h1>
    <div class="header_btn_sp user_menu_btn">
    </div>
  </div>
  <div class="header_menu pc">
    <h1 class="logo">
      @if(Request::is('/'))
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      @else
      <a href="/home">
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      </a>
      @endif
    </h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="menu_search_box">
              <form class="" action="{{url('search')}}">
                @if (isset($keyword))
                <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
                @else
                <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
                @endif
              </form>
            </div>
          </li>
          <li>
            @if (isset( $user ))
            <a href="/create" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @else
            <a href="/login" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/ranking_w" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @else
            <a href="/login" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/bookmark" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @else
            <a href="/login" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @endif
          </li>
          <!-- <li>
            <a href="#" class="news text_hover">{{ __('components.menu_news') }}</a>
          </li>pc切り替え-->
        </ul>
      </div>
      <div class="header_btn">

        @if (isset( $user ))
          <!-- ログインしている -->

          @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
          @if(File::exists($thumb_path))
          <img src="{{ asset($thumb_path) }}" alt="" class="object-fit user_menu_btn">
          @else
          <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit user_menu_btn">
          @endif

        @else
          <!-- ログインしていない -->
          <a href="/login" class="bd_orange bottom_hover">{{ __('components.menu_login') }}</a>
          <a href="/register/create" class="bg_orange bottom_hover">{{ __('components.menu_member_registration') }}</a>
        @endif

      </div>
    </div>
  </div>
  @elseif(Request::is('news/*'))
  <div class="header_menu sp">
    <a href="javascript:history.back();" class="back"></a>
    <h1 class="user">
      <!--{{$user->flip_id}}-->
      <a href="javascript:history.back();">通知</a>
    </h1>
    <div class="header_btn_sp user_menu_btn">
    </div>
  </div>
  <div class="header_menu pc">
    <h1 class="logo">
      @if(Request::is('/'))
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      @else
      <a href="/home">
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      </a>
      @endif
    </h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="menu_search_box">
              <form class="" action="{{url('search')}}">
                @if (isset($keyword))
                <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
                @else
                <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
                @endif
              </form>
            </div>
          </li>
          <li>
            @if (isset( $user ))
            <a href="/create" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @else
            <a href="/login" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/ranking_w" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @else
            <a href="/login" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/bookmark" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @else
            <a href="/login" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @endif
          </li>
          <!-- <li>
            <a href="#" class="news text_hover">{{ __('components.menu_news') }}</a>
          </li>pc切り替え-->
        </ul>
      </div>
      <div class="header_btn">

        @if (isset( $user ))
          <!-- ログインしている -->

          @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
          @if(File::exists($thumb_path))
          <img src="{{ asset($thumb_path) }}" alt="" class="object-fit user_menu_btn">
          @else
          <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit user_menu_btn">
          @endif

        @else
          <!-- ログインしていない -->
          <a href="/login" class="bd_orange bottom_hover">{{ __('components.menu_login') }}</a>
          <a href="/register/create" class="bg_orange bottom_hover">{{ __('components.menu_member_registration') }}</a>
        @endif

      </div>
    </div>
  </div>
  @elseif(Request::is('user_edit/*'))
  <div class="header_menu">
    <h1 class="logo">
      @if(Request::is('/'))
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      @else
      <a href="/home">
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      </a>
      @endif
    </h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="menu_search_box">
              <form class="" action="{{url('search')}}">
                @if (isset($keyword))
                <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
                @else
                <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
                @endif
              </form>
            </div>
          </li>
          <li>
            @if (isset( $user ))
            <a href="/create" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @else
            <a href="/login" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/ranking_w" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @else
            <a href="/login" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/bookmark" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @else
            <a href="/login" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @endif
          </li>
          <!-- <li>
            <a href="#" class="news text_hover">{{ __('components.menu_news') }}</a>
          </li>pc切り替え-->
        </ul>
      </div>
      <div class="header_btn sp">
        <a href="" class="save">保存</a>
      </div>
      <div class="header_btn pc">

        @if (isset( $user ))
          <!-- ログインしている -->

          @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
          @if(File::exists($thumb_path))
          <img src="{{ asset($thumb_path) }}" alt="" class="object-fit user_menu_btn">
          @else
          <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit user_menu_btn">
          @endif

        @else
          <!-- ログインしていない -->
          <a href="/login" class="bd_orange bottom_hover">{{ __('components.menu_login') }}</a>
          <a href="/register/create" class="bg_orange bottom_hover">{{ __('components.menu_member_registration') }}</a>
        @endif

      </div>
    </div>
  </div>
  @else
  <div class="header_menu">
    <h1 class="logo">
      @if(Request::is('/'))
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      @else
      <a href="/home">
        <img src="{{ asset('img/logo.svg') }}" alt="FLIP">
        <p><img src="{{ asset('img/flip_hash.svg') }}" alt="旅するSNS"></p>
      </a>
      @endif
    </h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="menu_search_box">
              <form class="" action="{{url('search')}}">
                @if (isset($keyword))
                <input type="search" name="keyword" value="{{ $keyword }}"  placeholder="{{ __('search.enter_keyword') }}">
                @else
                <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="{{ __('search.enter_keyword') }}">
                @endif
              </form>
            </div>
          </li>
          <li>
            @if (isset( $user ))
            <a href="/create" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @else
            <a href="/login" class="contribution text_hover">{{ __('components.menu_newPost') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/ranking_w" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @else
            <a href="/login" class="ranking text_hover">{{ __('components.menu_ranking') }}</a>
            @endif
          </li>
          <li>
            @if (isset( $user ))
            <a href="/bookmark" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @else
            <a href="/login" class="bookmark text_hover">{{ __('components.menu_bookmarks') }}</a>
            @endif
          </li>
          <!-- <li>
            <a href="#" class="news text_hover">{{ __('components.menu_news') }}</a>
          </li>pc切り替え-->
        </ul>
      </div>
      <div class="header_btn">

        @if (isset( $user ))
          <!-- ログインしている -->

          @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
          @if(File::exists($thumb_path))
          <img src="{{ asset($thumb_path) }}" alt="" class="object-fit user_menu_btn">
          @else
          <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit user_menu_btn">
          @endif

        @else
          <!-- ログインしていない -->
          <a href="/login" class="bd_orange bottom_hover">{{ __('components.menu_login') }}</a>
          <a href="/register/create" class="bg_orange bottom_hover">{{ __('components.menu_member_registration') }}</a>
        @endif

      </div>
    </div>
  </div>
  @endif

  @if (isset( $user ))
    <!-- ログインしている -->
    <ul id="user_menu">
      <li><a href="/user/{{$user->id}}">{{ __('components.menu_mypage') }}</a></li>
      <li>
        <a href="/bookmark">{{ __('components.menu_bookmarks') }}</a>
      </li>
      <li><a href="/user_edit">{{ __('components.menu_editprofile') }}</a></li>
      <li><a href="/user_follow/{{$user->id}}">{{ __('components.menu_follows') }}</a></li>
      <li><a href="/user_follower/{{$user->id}}">{{ __('components.menu_followers') }}</a></li>
      @if($user->block)
      @else
      <li><a href="/user_message">{{ __('components.menu_message') }}</a></li>
      @endif
      <li><a href="/notice/">{{ __('components.menu_notice') }}</a></li>
      <li><a href="/logout">{{ __('components.menu_logout') }}</a></li>
    </ul>
  @endif

</header>



<div id="post_create_btn" class="sp">
  <a href="/create"></a>
</div>
