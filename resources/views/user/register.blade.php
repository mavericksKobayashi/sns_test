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

<body id="welcome">
  @include('components.menu')


  <div class="cont">

    <h1 class="auth_ttl">{{ __('user.user_create_new_account') }}</h1>

    <form action="/register/create" accept-charset="utf-8" method="post">

      {{ csrf_field() }}


      <div class="exErrorMsg">
        @isset($message)
          <p>{{ $message }}</p>
        @endisset

        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach

        @if(Session::has('mail_error'))
          <p>{{ __('user.user_registered_email') }}</p>
        @endif
      </div>
      <style>
        .exErrorMsg {
          margin-bottom: 5px;
          text-align: center;
        }
        .exErrorMsg p {
          max-width: 327px;
          margin: 0 auto;
          color: #cc0000;
          font-size: 14px;
          line-height: 1.3;
          text-align: left;
        }
        form {
          position: relative;
        }
        form .note {
          display: block;
          max-width: 327px;
          margin: 0 auto 5px;
          text-align: right;
          font-size: 10px;
          box-sizing: border-box;
        }
      </style>


      <p class="note">* {{ __('user.user_required') }}</p>

      <input autofocus="autofocus" name="email" value="{{old('email')}}" type="text" placeholder="{{ __('user.user_email') }} *">

      <input name="password" value="{{old('password')}}" type="password" placeholder="{{ __('user.user_password') }} *">

      <input autofocus="autofocus" name="nickname" value="{{old('nickname')}}" type="text" placeholder="{{ __('user.user_nickname') }} *">

      <input autofocus="autofocus" name="place" value="{{old('place')}}" type="text" placeholder="{{ __('user.user_place') }}">

      <div class="select_box">
        <select name="gender" data-selected="{{ old('gender') }}">
          <option value="{{ __('user.user_choose_gender') }}">{{ __('user.user_choose_gender') }}</option>
          <option value="{{ __('user.user_man') }}">{{ __('user.user_man') }}</option>
          <option value="{{ __('user.user_woman') }}">{{ __('user.user_woman') }}</option>
          <option value="{{ __('user.user_other') }}">{{ __('user.user_other') }}</option>
        </select>
      </div>

      <input value="{{ __('user.user_create_account') }}" name="{{ __('user.user_create_account') }}" type="submit" class="common_btn bottom_hover">

      <p class="logout"><a href="/logout">{{ __('user.user_logout') }}</a></p>

    </form>

  </div>






  @include('components.footer')
</body>
</html>
