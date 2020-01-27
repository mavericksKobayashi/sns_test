@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin-index.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_top">
  @include('components.menu_admin')
  <!-- <div class="breadcrumb">
    <div class="inner">
      <a href="#">FLIPとは</a>
    </div>
  </div> -->
  <div class="admin_summary">
    <div class="inner">
      <div class="admin_summary_box_wrap">
        <div class="admin_summary_box admin_summary_box01">
          <h2>
            <span class="admin_summary_ttl">本日の投稿数</span>
            <span class="admin_summary_num">{{ $to_day_posts }}</span>
            <span class="admin_summary_how">件</span>
          </h2>
          <ul>
            <li>
              <p class="admin_summary_sub">昨日の投稿数</p>
              <span class="admin_summary_sub_num">{{ $yesterday_posts }}<span>件</span></span>
            </li>
            <li>
              <p class="admin_summary_sub">一昨日の投稿数</p>
              <span class="admin_summary_sub_num">{{ $day_before_posts }}<span>件</span></span>
            </li>
          </ul>
        </div>
        <div class="admin_summary_box">
          <h2>
            <span class="admin_summary_ttl">会員数</span>
            <span class="admin_summary_num">{{ $members }}</span>
            <span class="admin_summary_how">件</span>
          </h2>
          <ul>
            <li>
              <p class="admin_summary_sub">今月会員になった人</p>
              <span class="admin_summary_sub_num">{{ $current_month_members }}<span>件</span></span>
            </li>
            <li>
              <p class="admin_summary_sub">先月会員になった人</p>
              <span class="admin_summary_sub_num">{{ $last_month_members }}<span>件</span></span>
            </li>
          </ul>
        </div>
      </div>
      <!-- admin_summary_box -->
      <div class="admin_notice">
        <div class="admin_notice_contact">
          <a href="" class="btn">
            <p>お問い合わせ</p>
            <span>12<span>件</span></span>
          </a>
        </div>
        <div class="admin_notice_report">
          <a href="" class="btn">
            <p>通報</p>
            <span>2<span>件</span></span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- admin_summary -->
  <div class="admin_userlist">
    <div class="inner">
      <h3>新規ユーザー</h3>
      <ul class="list_ttl">
        <li>
          <div class="admin_userlist_box">
            <div class="admin_userlist_name">名前</div>
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
        <li>
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
            <div class="admin_userlist_name"><img src="{{ asset('img/no_user_profile.png') }}" class="img_round">なし</div>
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
      <div class="to_user_list"><a href="/admin/user" class="btn">ユーザー一覧へ</a></div>
    </div>
  </div>
  <!-- admin_userlist -->
  <script src="../js/admin.js"></script>
</body>
</html>
