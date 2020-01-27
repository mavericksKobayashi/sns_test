@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin-form.css') }}" rel="stylesheet">
<link href="{{ asset('css/create.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_user admin_postedit">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="#">HOME</a>
      <a href="#">POST</a>
      <a href="#">@tanimura</a>
    </div>
  </div>
  <div class="post_edit_wrapper">
    <div class="inner">
      <div class="post_content" id="create">
        <p class="back_to_userlist"><a href="/admin/post">一覧へ戻る</a></p>
        <div class="to_freeze_account">
          <span>凍結</span>
          <div class="public_btn">
            <input data-index="0" id="public" type="checkbox">
            <label for="public"></label>
          </div>
        </div>
        <div class="thumnail_sp sp"></div>
        <div class="inner">
          <div class="create_post other_content">
            <div class="create_post_img">
              <div id="preview" style="display:none"></div>
              <form action="/uploads" enctype="multipart/form-data">
                <div id="cool_upload">
                  <img src="../img/icon_upload.svg" id="cool_upload_image">
                  <input type="file" name="icon" multiple="multiple" accept="image/*" id="cool_upload_form">
                </div>
              </form>
            </div>
            <div class="create_post_place">
              <input type="text" name="place" placeholder="場所を検索">
            </div>
            <div class="create_post_kuchikomi">
              <textarea name="kuchikomi" id="" placeholder="口コミを入力"></textarea>
              <span>0/300</span>
            </div>
            <div class="create_post_tag">
              <input type="text" name="tag" placeholder="タグを入力">
              <div class="tags"><span><a href="">八ヶ岳</a></span><span><a href="">山歩き</a></span></div>
            </div>
            <div class="create_post_category">
              <div class="create_post_category01">
                <select class="cp_sl" required>
                  <option value="" hidden disabled selected>カテゴリを選択</option>
                  <option value="1">cat</option>
                  <option value="2">dog</option>
                  <option value="3">rabbit</option>
                  <option value="4">squirrel</option>
                </select>
              </div>
              <div class="create_post_category02">
                <select class="cp_sl" required>
                  <option value="" hidden disabled selected>2019.09.09 訪問</option>
                  <option value="1">cat</option>
                  <option value="2">dog</option>
                  <option value="3">rabbit</option>
                  <option value="4">squirrel</option>
                </select>
              </div>
            </div>
            <div class="good_public">
              <div class="create_post_goodness_wrap">
                <p>いってよかった</p>
                <div class="create_post_goodness">
                  <input type="range" class="range" min="1" max="5" step="1" value="3">
                  <span class="range_btn01"></span>
                  <span class="range_btn02"></span>
                  <span class="range_btn03"></span>
                  <span class="range_btn04"></span>
                  <span class="range_btn05"></span>
                  <span class="range_btn_giji range_btn_giji01"></span>
                  <span class="range_btn_giji range_btn_giji02"></span>
                  <span class="range_btn_giji range_btn_giji03"></span>
                  <span class="range_btn_giji range_btn_giji04"></span>
                  <span class="range_btn_giji range_btn_giji05"></span>
                </div>
              </div>
              <div class="public_btn_wrap pc">
                <span>公開設定</span>
                <div class="public_btn_area">
                  <p>公開する</p>
                  <div class="public_btn">
                    <input data-index="0" id="public" type="checkbox">
                    <label for="public"></label>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" class="create_post_submit bottom_hover" value="投稿する">
            <p class="create_post_save sp"><a href="">下書きに保存</a></p>
          </div>
        </div>
      </div>
      <!-- post content -->
      <div class="comment_area">
        <div class="comment_ttl">
          コメント
        </div>
        <div class="contributor">
          <div class="comment_box">
            <p class="name">モコミチ</p>
            <p class="comment">&gt;らっこさん<br>Acquaには、最高の訓練を受けた最もプロフェッショナルな人材がいます。</p>
            <p class="date">5分前</p>
          </div>
          <div class="user_icon">
            <img src="http://flip.localhost/img/user_icon_moko.jpg" alt="" class="object-fit">
          </div>
        </div>
        <div class="etcetera">
          <div class="user_icon">
            <img src="http://flip.localhost/img/post_img_1.jpg" alt="" class="object-fit">
          </div>
          <div class="comment_box">
            <p class="name">らっこ</p>
            <p class="comment">私はPVにいるたびにAcquaint Spaに戻ります。私は決して失望しません。清潔で広々とした素敵なマッサージルームとシャワー付きのロッカールームがあります。私は常に優れたプロのマッサージを受けています。 PVには多くのいわゆるマッサージ師がいます。 Acquaには、最高の訓練を受けた最もプロフェッショナルな人材がいます。</p>
            <p class="date">2時間前</p>
          </div>
        </div>
      </div>
      <!-- comment area -->
      </div>
  </div>
  <script src="../js/admin.js"></script>
  <script src="../js/create.js"></script>
</body>
</html>
