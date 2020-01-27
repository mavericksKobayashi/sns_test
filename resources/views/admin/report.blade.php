@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_report">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="#">HOME</a>
      <a href="#">POST</a>
    </div>
  </div>
  <div class="wrapper_plus">
    <div class="admin_sidebar">
      @include('components.admin_sidebar_post')
    </div>
    <div class="admin_userlist">
      <div class="inner">
        <div class="serch_word"><input type="text" placeholder="検索ワード"></div>
        <h3>通報一覧</h3>
        <ul class="list_ttl">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">ID</div>
              <div class="admin_userlist_photo">写真</div>
              <div class="admin_userlist_category">カテゴリ</div>
              <div class="admin_userlist_bleach">違反理由</div>
              <div class="admin_userlist_bleachstatus">対応状況</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit">編集</div>
          </li>
        </ul>
        <ul class="admin_list">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">@tanimura</div>
              <div class="admin_userlist_photo"><img src="../img/user_icon_moko.jpg" alt=""></div>
              <div class="admin_userlist_category">飲食店</div>
              <div class="admin_userlist_bleach">不適切な画像の投稿</div>
              <div class="admin_userlist_bleachstatus unresolved">未対応</div>
              <div class="admin_userlist_date">2019-05-25</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">@tanimura</div>
              <div class="admin_userlist_photo"><img src="../img/user_icon_moko.jpg" alt=""></div>
              <div class="admin_userlist_category">飲食店</div>
              <div class="admin_userlist_bleach">不適切な画像の投稿</div>
              <div class="admin_userlist_bleachstatus resolved">対応済み</div>
              <div class="admin_userlist_date">2019-05-25</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">@tanimura</div>
              <div class="admin_userlist_photo"><img src="../img/user_icon_moko.jpg" alt=""></div>
              <div class="admin_userlist_category">飲食店</div>
              <div class="admin_userlist_bleach">不適切な画像の投稿</div>
              <div class="admin_userlist_bleachstatus resolved">対応済み</div>
              <div class="admin_userlist_date">2019-05-25</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">@tanimura</div>
              <div class="admin_userlist_photo"><img src="../img/user_icon_moko.jpg" alt=""></div>
              <div class="admin_userlist_category">飲食店</div>
              <div class="admin_userlist_bleach">不適切な画像の投稿</div>
              <div class="admin_userlist_bleachstatus resolved">対応済み</div>
              <div class="admin_userlist_date">2019-05-25</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">@tanimura</div>
              <div class="admin_userlist_photo"><img src="../img/user_icon_moko.jpg" alt=""></div>
              <div class="admin_userlist_category">飲食店</div>
              <div class="admin_userlist_bleach">不適切な画像の投稿</div>
              <div class="admin_userlist_bleachstatus resolved">対応済み</div>
              <div class="admin_userlist_date">2019-05-25</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">@tanimura</div>
              <div class="admin_userlist_photo"><img src="../img/user_icon_moko.jpg" alt=""></div>
              <div class="admin_userlist_category">飲食店</div>
              <div class="admin_userlist_bleach">不適切な画像の投稿</div>
              <div class="admin_userlist_bleachstatus resolved">対応済み</div>
              <div class="admin_userlist_date">2019-05-25</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
        </ul>
      </div>
    </div>
    <!-- admin_userlist -->
  </div>
  <!-- wrapper plus -->
  <script src="../js/admin.js"></script>
</body>
</html>
