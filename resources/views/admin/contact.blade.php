@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_contact">
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
        <h3>お問い合わせ一覧</h3>
        <ul class="list_ttl">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">ID</div>
              <div class="admin_userlist_nameonly">名前</div>
              <div class="admin_userlist_category">カテゴリ</div>
              <div class="admin_userlist_contactcontent">お問い合わせ内容</div>
              <div class="admin_userlist_replystatus">返信状況</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit">編集</div>
          </li>
        </ul>
        <ul class="admin_list">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus unreplyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
            </div>
            <div class="admin_userlist_edit"><a href=""><span></span><span></span><span></span></a></div>
          </li>
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">1011</div>
              <div class="admin_userlist_nameonly">もこみち</div>
              <div class="admin_userlist_category">登録内容について</div>
              <div class="admin_userlist_contactcontent">IDを「olive buscket」に変更したい</div>
              <div class="admin_userlist_replystatus replyed">未対応</div>
              <div class="admin_userlist_date">登録日</div>
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
