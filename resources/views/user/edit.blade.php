@include('components.header')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

<script>
  $(function(){
    // セレクトボックスの値保持
    $('select').each(function () {
      var select = $(this);
      var selected = $(this).data('selected');
      select.children('option[value="' + selected + '"]').prop('selected', true);
    });
  });
</script>

</head>

<body id="edit">
  @include('components.menu')


  <div class="cont">



    <form action="/user_edit" accept-charset="utf-8" method="POST" enctype="multipart/form-data" style="padding-top:0;">

      {{ csrf_field() }}


      <div style="padding-bottom:20px;">
        <input type="file" name="image_prof" id="file_01" style="display:none;">
        <label class="g_file_mask">

          <div class="user_icon">

            @php $thumb_path = 'uploads/'.$user->id.'/user_profile.jpg'; @endphp
            @if(File::exists($thumb_path))
              <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
            @else
              <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
            @endif

          </div>
          <!--<input type="text" id="mask_file_01">-->
        </label>
      </div>

      <script>
        $(function(){
        setTimeout(function() {
          //$('#file_01').change(function(){
          //  $('#mask_file_01').val($('#file_01').val());
          //});
          $('.g_file_mask').on('click',function(){
            $('#file_01').trigger('click');
          });

          // プレビュー
          $('#file_01').on('change', function (e) {
            var reader = new FileReader();
            var preview_target = '.user_icon img';
            reader.onload = function (e) {
              $(preview_target).attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
          });

        }, 200);
        });
      </script>



      <div class="exErrorMsg mgn">

        @isset($message)
        <p>{{ $message }}</p>
        @endisset

        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach

        @if(Session::has('mail_error'))
        <p>{{session('mail_error')}}</p>
        @endif

        @if(Session::has('flip_error'))
        <p>{{session('flip_error')}}</p>
        @endif

        @if(Session::has('image_error'))
        <p>{{session('image_error')}}</p>
        @endif

      </div>

      <style>
        .exErrorMsg {
          text-align: center;
          padding-bottom: 10px;
        }
        .exErrorMsg p {
          max-width: 350px;
          margin: 0 auto;
          color: #cc0000;
          font-size: 14px;
          line-height: 1.3;
          text-align: left;
        }
        .exErrorMsg.mgn {
          margin-top: 20px;
        }
      </style>


      <p class="input_name">{{ __('user.user_email') }} *</p>
      @if($user->email)
      <input autofocus="autofocus" name="email" value="{{$user->email}}" type="text" placeholder="{{ __('user.user_email') }}">
      @else
      <input autofocus="autofocus" name="email" value="{{old('email')}}" type="text" placeholder="{{ __('user.user_email') }}">
      @endif

      <p class="input_name">FLIP ID *</p>
      @if($user->flip_id)
      <input autofocus="autofocus" name="flip_id" value="{{$user->flip_id}}" type="text" placeholder="FLIP ID">
      @else
      <input autofocus="autofocus" name="flip_id" value="{{old('flip_id')}}" type="text" placeholder="FLIP ID">
      @endif

      <p class="input_name">{{ __('user.user_nickname') }} *</p>
      @if($user->nickname)
      <input autofocus="autofocus" name="nickname" value="{{$user->nickname}}" type="text" placeholder="{{ __('user.user_nickname') }}">
      @else
      <input autofocus="autofocus" name="nickname" value="{{old('nickname')}}" type="text" placeholder="{{ __('user.user_nickname') }}">
      @endif

      <p class="input_name">{{ __('user.user_place') }}</p>
      @if($user->nickname)
      <input autofocus="autofocus" name="place" value="{{$user->place}}" type="text" placeholder="{{ __('user.user_place') }}">
      @else
      <input autofocus="autofocus" name="place" value="{{old('place')}}" type="text" placeholder="{{ __('user.user_place') }}">
      @endif

      <p class="input_name">{{ __('user.user_sex') }}</p>
      <div class="select_box">
        @if($user->gender)
        <select name="gender" data-selected="{{$user->gender}}">
        @else
        <select name="gender" data-selected="{{ old('gender') }}">
        @endif
        @if($user->gender == '')
          <option value="" selected>{{ __('user.user_choose_gender') }}</option>
          <option value="男性">{{ __('user.user_man') }}</option>
          <option value="女性">{{ __('user.user_woman') }}</option>
          <option value="その他">{{ __('user.user_other') }}</option>
        @elseif($user->gender == '男性')
          <option value="">{{ __('user.user_choose_gender') }}</option>
          <option value="男性" selected>{{ __('user.user_man') }}</option>
          <option value="女性">{{ __('user.user_woman') }}</option>
          <option value="その他">{{ __('user.user_other') }}</option>
        @elseif($user->gender == '女性')
          <option value="">{{ __('user.user_choose_gender') }}</option>
          <option value="男性">{{ __('user.user_man') }}</option>
          <option value="女性" selected>{{ __('user.user_woman') }}</option>
          <option value="その他">{{ __('user.user_other') }}</option>
        @elseif($user->gender == 'その他')
          <option value="">{{ __('user.user_choose_gender') }}</option>
          <option value="男性">{{ __('user.user_man') }}</option>
          <option value="女性">{{ __('user.user_woman') }}</option>
          <option value="その他" selected>{{ __('user.user_other') }}</option>
        @endif
        </select>
      </div>

      <p class="input_name">{{ __('user.user_intro') }}</p>
      @if($user->self_intro)
      <textarea name="self_intro" rows="8" cols="80" placeholder="{{ __('user.user_intro_ph') }}">{{$user->self_intro}}</textarea>
      @else
      <textarea name="self_intro" rows="8" cols="80" placeholder="{{ __('user.user_intro_ph') }}">{{old('self_intro')}}</textarea>
      @endif


      @if( 1 == 0)
      <!-- 非公開にする -->
      <div class="public_btn">
        <p class="input_name">{{ __('user.user_private') }}</p>
        <label class="label--checkbox" for="public">
          @if($user->locked)
          <input class="checkbox" name="locked" data-index="0" id="public" type="checkbox" value="1" checked="checked">
          @else
          <input class="checkbox" name="locked" data-index="0" id="public" type="checkbox" value="1">
          @endif
        </label>
      </div>
      @endif

      <!-- メッセージ機能ブロック -->
      <div class="public_btn">
        <p class="input_name">{{ __('user.user_no_message') }}</p>
        <label class="label--checkbox" for="public">
          @if($user->block)
          <input class="checkbox" name="block" data-index="0" id="public" type="checkbox" value="1" checked="checked">
          @else
          <input class="checkbox" name="block" data-index="0" id="public" type="checkbox" value="1">
          @endif
        </label>
      </div>


      <input value="{{ __('user.user_update') }}" name="{{ __('user.user_update') }}" type="submit" class="common_btn">

      <p class="logout"><a href="/logout">{{ __('user.user_logout') }}</a></p>

    </form>

  </div>



  @include('components.footer')
</body>
</html>
