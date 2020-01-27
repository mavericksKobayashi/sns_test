@include('components.header')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin-form.css') }}" rel="stylesheet">

</head>

<body id="admin" class="admin_user admin_useredit">
  @include('components.menu_admin')
  <div class="breadcrumb">
    <div class="inner">
      <a href="#">HOME</a>
      <a href="#">POST</a>
      <a href="#"><span>@</span>{{$edit_user->flip_id}}</a>
    </div>
  </div>
  <div class="wrapper_plus">
    <div class="admin_userlist">
      <div class="inner">
        <p class="back_to_userlist"><a href="/admin/user">一覧へ戻る</a></p>
        <div class="cont">
          <form action="/admin/user_edit/{{$edit_user_id}}" accept-charset="utf-8" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="to_freeze_account">
              <span>凍結</span>
              <div class="public_btn">
                @if($edit_user->freeze)
                <input class="checkbox" name="freeze" data-index="0" id="public" type="checkbox" value="1" checked="checked">
                @else
                <input class="checkbox" name="freeze" data-index="0" id="public" type="checkbox" value="1">
                @endif
                <label for="public"></label>
              </div>
            </div>

            <div style="padding-bottom:20px;">
              <input type="file" name="image_prof" id="file_01" style="display:none;">
              <label class="g_file_mask">
                <div class="user_icon">
                  @php $thumb_path = 'uploads/'.$edit_user->id.'/user_profile.jpg'; @endphp
                  @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                  @else
                    <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                  @endif
                </div>
              </label>
            </div>
            <p class="input_name">メールアドレス *</p>
            @if($edit_user->email)
            <input autofocus="autofocus" name="email" value="{{$edit_user->email}}" type="text" placeholder="{{ __('user.user_email') }}">
            @else
            <input autofocus="autofocus" name="email" value="{{old('email')}}" type="text" placeholder="{{ __('user.user_email') }}">
            @endif
            <p class="input_name">FLIP ID *</p>
            @if($edit_user->flip_id)
            <input autofocus="autofocus" name="flip_id" value="{{$edit_user->flip_id}}" type="text" placeholder="FLIP ID">
            @else
            <input autofocus="autofocus" name="flip_id" value="{{old('flip_id')}}" type="text" placeholder="FLIP ID">
            @endif
            <p class="input_name">ニックネーム *</p>
            @if($edit_user->nickname)
            <input autofocus="autofocus" name="nickname" value="{{$edit_user->nickname}}" type="text" placeholder="{{ __('user.user_nickname') }}">
            @else
            <input autofocus="autofocus" name="nickname" value="{{old('nickname')}}" type="text" placeholder="{{ __('user.user_nickname') }}">
            @endif
            <p class="input_name">場所</p>
            @if($edit_user->place)
            <input autofocus="autofocus" name="place" value="{{$edit_user->place}}" type="text" placeholder="{{ __('user.user_place') }}">
            @else
            <input autofocus="autofocus" name="place" value="{{old('place')}}" type="text" placeholder="{{ __('user.user_place') }}">
            @endif
            <p class="input_name">性別</p>
            <div class="select_box">
              @if($edit_user->gender)
              <select name="gender" data-selected="{{$edit_user->gender}}">
              @else
              <select name="gender" data-selected="{{ old('gender') }}">
              @endif
              @if($edit_user->gender == '')
                <option value="" selected>性別を選択してください</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
                <option value="その他">その他</option>
              @elseif($edit_user->gender == '男性')
                <option value="">性別を選択してください</option>
                <option value="男性" selected>男性</option>
                <option value="女性">女性</option>
                <option value="その他">その他</option>
              @elseif($edit_user->gender == '女性')
                <option value="">性別を選択してください</option>
                <option value="男性">男性</option>
                <option value="女性" selected>女性</option>
                <option value="その他">その他</option>
              @elseif($edit_user->gender == 'その他')
                <option value="">性別を選択してください</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
                <option value="その他" selected>その他</option>
              @endif
              </select>
            </div>
            <p class="input_name">自己紹介</p>
            @if($edit_user->self_intro)
            <textarea name="self_intro" rows="8" cols="80" placeholder="{{ __('user.user_intro_ph') }}">{{$edit_user->self_intro}}</textarea>
            @else
            <textarea name="self_intro" rows="8" cols="80" placeholder="{{ __('user.user_intro_ph') }}">{{old('self_intro')}}</textarea>
            @endif

            <!-- メッセージ機能ブロック -->
            <div class="public_btn">
              <p class="input_name">メッセージ機能ブロック</p>
                @if($edit_user->block)
                <input class="checkbox" name="block" data-index="0" id="public_2" type="checkbox" value="1" checked="checked">
                @else
                <input class="checkbox" name="block" data-index="0" id="public_2" type="checkbox" value="1">
                @endif
                <label for="public_2"></label>
            </div>

            <input value="{{ __('user.user_update') }}" name="{{ __('user.user_update') }}" type="submit" class="common_btn">

          </form>
        </div>
      </div>
    </div>
    <!-- admin_userlist -->
  </div>
  <!-- wrapper plus -->
  <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
