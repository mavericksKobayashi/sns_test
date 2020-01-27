@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin-form.css') }}" rel="stylesheet">
<link href="{{ asset('css/create.css') }}" rel="stylesheet">

<!-- redactor -->
<link type="text/css" rel="stylesheet" href="{{ asset('redactor/redactor.min.css') }}">
<script type="text/javascript" src="{{ asset('redactor/redactor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('redactor/_plugins/fontsize/fontsize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('redactor/_plugins/fontcolor/fontcolor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('redactor/_plugins/alignment/alignment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('redactor/_langs/ja.js') }}"></script>
<script>
  $(function(){
    $('textarea').redactor({
      imageUpload: '/uploads/upload.php',
      lang: 'ja',
      plugins: ['source','alignment','fontcolor','fontsize'],
    });
  });
</script>

</head>

<body id="admin" class="admin_news">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="/admin/">HOME</a>
      <a href="/admin/news/">NEWS</a>
    </div>
  </div>
  <div class="post_edit_wrapper admin_newsedit">
    <div class="inner">
      <div class="post_content" id="create">
        <p class="back_to_userlist"><a href="/admin/news">一覧へ戻る</a></p>

        <form id="news_create" action="/admin/news_create" accept-charset="utf-8" method="POST" enctype="multipart/form-data" >

          @csrf

          <div class="to_freeze_account">
            <span>公開</span>
            <div class="public_btn">
              <input name="publish" data-index="0" id="public" type="checkbox" value="1">
              <label for="public"></label>
            </div>
          </div>

          <div class="inner">
            <div class="create_post other_content">

              <div class="create_post_place">
                <input type="text" name="title">
              </div>

              <div class="create_post_contents">
                <textarea name="contents" id=""></textarea>
              </div>

              <div class="create_post_category">

                <div class="create_post_category01">
                  <p>作成者</p>
                  <input type="text" name="writer" class="cp_sl">
                </div>

                <div class="create_post_category02">
                  <p>公開日</p>
                  <input type="text" name="release_date"  class="cp_sl" value="{{  \Carbon\Carbon::now()->format("Ymd")  }}">
                </div>

              </div>

              <input type="submit" class="create_post_submit bottom_hover" value="投稿する">
            </div>
          </div>

        </form>
      </div>
      <!-- post content -->
    </div>
  </div>
  <script src="../js/admin.js"></script>
</body>
</html>
