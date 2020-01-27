@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin-user.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_user">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="#">HOME</a>
      <a href="#">USER</a>
    </div>
  </div>
  <div class="wrapper_plus">
    <div class="admin_sidebar">
      @include('components.admin_sidebar_user')
    </div>
    <div class="admin_userlist">
      <div class="inner">
        <div class="serch_word">
          <form class="" action="{{url('admin/user')}}">
            <input type="search" name="keyword" value="{{ old('keyword') }}"  placeholder="検索ワード">
          </form>
        </div>
        <h3>ユーザー一覧</h3>
        <ul class="list_ttl">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_name">名前</div>
              <div class="admin_userlist_id">ID</div>
              <div class="admin_userlist_follow">フォロー</div>
              <div class="admin_userlist_follower">フォロワー</div>
              <div class="admin_userlist_like">いいね数</div>
              <div class="admin_userlist_post">投稿数</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit">編集</div>
          </li>
        </ul>
        <ul class="admin_list">
          @if(!empty($user_datas[0]))
          @foreach($user_datas as $user_data)
          <li id="{{ $user_data[7] }}">
            <div class="admin_userlist_box">
              <div class="admin_userlist_name">
                @php $thumb_path = 'uploads/'.$user_data[0].'/user_profile.jpg'; @endphp
                @if(File::exists($thumb_path))
                <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                @else
                <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                @endif
                {{ $user_data[1] }}
              </div>
              <div class="admin_userlist_id"><span>@</span>{{ $user_data[8] }}</div>
              <div class="admin_userlist_follow">{{ $user_data[2] }}</div>
              <div class="admin_userlist_follower">{{ $user_data[3] }}</div>
              <div class="admin_userlist_like">{{ $user_data[4] }}</div>
              <div class="admin_userlist_post">{{ $user_data[5] }}</div>
              <div class="admin_userlist_date">{{ $user_data[6] }}</div>
            </div>
            <div class="admin_userlist_edit"><a href="/admin/user_edit/{{ $user_data[0] }}"><span></span><span></span><span></span></a></div>
          </li>
          @endforeach
          @else
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_name">なし</div>
              <div class="admin_userlist_id">なし</div>
              <div class="admin_userlist_follow">なし</div>
              <div class="admin_userlist_follower">なし</div>
              <div class="admin_userlist_like">なし</div>
              <div class="admin_userlist_post">なし</div>
              <div class="admin_userlist_date">なし</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          @endif
        </ul>
      </div>
    </div>
    <!-- admin_userlist -->
  </div>
  <!-- wrapper plus -->
  <script src="../js/admin.js"></script>
</body>
</html>
