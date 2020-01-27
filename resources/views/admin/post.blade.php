@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_post">
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
        <div class="serch_word">
          <form class="" action="{{request()->fullUrl()}}">
            <input type="search" name="keyword" value="{{ old('keyword') }}" placeholder="検索ワード">
          </form>
        </div>
        <h3>投稿一覧</h3>
        <ul class="list_ttl">
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">ID</div>
              <div class="admin_userlist_photo">写真</div>
              <div class="admin_userlist_bookmark">ブックマーク数</div>
              <div class="admin_userlist_like">いいね数</div>
              <div class="admin_userlist_comment">コメント数</div>
              <div class="admin_userlist_category">カテゴリ</div>
              <div class="admin_userlist_date">登録日</div>
              <div class="admin_userlist_freeze">凍結</div>
            </div>
            <div class="admin_userlist_edit">確認</div>
          </li>
        </ul>
        <ul class="admin_list">
          @if(!empty($post_datas[0]))
          @foreach($post_datas as $post_data)
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id"><span>@</span>{{ $post_data[0] }}</div>
              <div class="admin_userlist_photo">
                @php
                  // サムネイル
                  if($post_data[3]){
                    $extension = 'jpg';
                    if($post_data[4] == 'image/png'){
                      $extension = 'png';
                    }
                    $thumb_path = 'uploads/'.$post_data[1].'/post_'.$post_data[2].'_'.$post_data[5].'_thumb.'.$extension;
                  } else {
                    // データベースに画像データがない
                    $thumb_path = 'img/no_image_post.png';
                  }
                @endphp
                @if(File::exists($thumb_path))
                <img src="{{ asset($thumb_path) }}" alt="" class="img_round">
                @else
                <img src="{{ asset('img/no_user_profile.png') }}" class="img_round">
                @endif
              </div>
              <div class="admin_userlist_bookmark">{{ $post_data[6] }}</div>
              <div class="admin_userlist_like">{{ $post_data[7] }}</div>
              <div class="admin_userlist_comment">{{ $post_data[8] }}</div>
              <div class="admin_userlist_category">{{ $post_data[9] }}</div>
              <div class="admin_userlist_date">{{ $post_data[10] }}</div>
              <div class="admin_userlist_freeze">
                <form class="" action="/admin/post/{{$post_data[2]}}"  accept-charset="utf-8" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="freeze_btn">
                    @if($post_data[11] == 1)
                    <input name="freeze" data-index="0" id="public{{$post_data[2]}}" type="submit" value="0">
                    <label class="action" for="public{{$post_data[2]}}">解除する</label>
                    @else
                    <input name="freeze" data-index="0" id="public{{$post_data[2]}}" type="submit" value="1">
                    <label for="public{{$post_data[2]}}">凍結する</label>
                    @endif
                  </div>
                </form>
              </div>
            </div>
            <div class="admin_userlist_edit"><a href="/post/{{ $post_data[2] }}"><span></span><span></span><span></span></a></div>
          </li>
          @endforeach
          @else
          <li>
            <div class="admin_userlist_box">
              <div class="admin_userlist_id">なし</div>
              <div class="admin_userlist_photo"><img src="{{ asset('img/no_user_profile.png') }}" class="img_round"></div>
              <div class="admin_userlist_bookmark">なし</div>
              <div class="admin_userlist_like">なし</div>
              <div class="admin_userlist_comment">なし</div>
              <div class="admin_userlist_category">なし</div>
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
