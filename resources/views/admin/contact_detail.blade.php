@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin-form.css') }}" rel="stylesheet">
</head>

<body id="admin" class="admin_contact">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="#">HOME</a>
      <a href="#">CONTACT</a>
      <a href="#">1001</a>
    </div>
  </div>
  <div class="admin_contactlist">
    <div class="inner">
      <p class="back_to_userlist"><a href="/admin/post">一覧へ戻る</a></p>
      <div class="admin_contactlist_items">
        <div class="admin_contactlist_item contact_status">
          <p>対応状況</p>
          <span>
            <div class="to_freeze_account">
              <div class="public_btn">
                <input data-index="0" id="public" type="checkbox">
                <label for="public"></label>
              </div>
              <span>対応済み</span>
            </div>
          </span>
        </div>
        <div class="admin_contactlist_item contact_date">
          <p>登録日</p>
          <span>2019-09-09</span>
        </div>
        <div class="admin_contactlist_item contact_name">
          <p>名前</p>
          <span>もこみち</span>
        </div>
        <div class="admin_contactlist_item contact_category">
          <p>カテゴリ</p>
          <span>登録内容について</span>
        </div>
        <div class="admin_contactlist_item contact_content">
          <p>お問い合わせ内容</p>
          <span>IDを「olive_bukkake」に変更したいですIDを「olive_bukkake」に変更したいですIDをIDを「olive_bukkake」に変更したいですIDを「olive_bukkake」に変更したいですIDをIDを「olive_bukkake」に変更したいですIDを「olive_bukkake」に変更したいですIDをIDを「olive_bukkake」に変更したいですIDを「olive_bukkake」に変更したいですIDをIDを「olive_bukkake」に変更したいですIDを「olive_bukkake」に変更したいですIDを</span>
        </div>
      </div>
      <p class="back_to_userlist"><a href="/admin/post">一覧へ戻る</a></p>
    </div>
  </div>
  <!-- admin_userlist -->
  <script src="../js/admin.js"></script>
</body>
</html>
