@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_news">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="/admin/">HOME</a>
      <a href="/admin/news">NEWS</a>
    </div>
  </div>
  <div class="wrapper_plus">
    <div class="admin_sidebar">
      @include('components.admin_sidebar_news')
    </div>
    <div class="admin_userlist">
      <div class="inner">
        <div class="create_new_news"><a href="/admin/news_create/" class="btn">新規作成</a></div>
        <h3>ニュース一覧</h3>
        <ul class="list_ttl">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_ttl">タイトル</div>
              <div class="admin_userlist_creater">作成者</div>
              <div class="admin_userlist_date">公開日</div>
              <div class="admin_userlist_publicstatus">公開状況</div>
            </div>
            <div class="admin_userlist_edit">編集</div>
          </li>
        </ul>
        <ul class="admin_list">
          @if(!empty($news_lists[0]))
          @foreach($news_lists as $news_list)
            <li>
              <div class="admin_userlist_box">
                <div class="admin_userlist_ttl">{{ $news_list->title }}</div>
                <div class="admin_userlist_creater">{{ $news_list->writer }}</div>
                <div class="admin_userlist_date">{{ $news_list->release_date }}</div>
                @if ($news_list->publish == 1)
                <div class="admin_userlist_publicstatus">公開</div>
                @else
                <div class="admin_userlist_publicstatus nonpublic">非公開</div>
                @endif
              </div>
              <div class="admin_userlist_edit"><a href="/admin/news_edit/{{ $news_list->id }}"><span></span><span></span><span></span></a></div>
            </li>
          @endforeach
          @else
            <li>
              <div class="admin_userlist_box">
                <div class="admin_userlist_ttl">なし</div>
                <div class="admin_userlist_creater">なし</div>
                <div class="admin_userlist_date">なし</div>
                <div class="admin_userlist_publicstatus nonpublic">なし</div>
              </div>
              <div class="admin_userlist_edit"><a href="/admin/news_edit/"><span></span><span></span><span></span></a></div>
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
