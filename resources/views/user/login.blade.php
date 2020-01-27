@include('components.header')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

</head>

<body id="login">
  @include('components.menu')
  <!-- フラッシュメッセージ -->
  @if (session('flash_message'))
      <div class="flash_message flash_message_success">
          <p>{{ session('flash_message') }}</p>
      </div>
  @endif

  <div class="cont">

    <h1 class="auth_ttl">{{ __('user.user_login') }}</h1>


    <form action="/login" accept-charset="utf-8" method="post">

      {{ csrf_field() }}


      <div class="exErrorMsg">
        @isset($message)
          <p>{{ $message }}</p>
        @endisset

        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
      <style>
        .exErrorMsg {
          margin-bottom: 10px;
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
      </style>


      <input autofocus="autofocus" name="email" value="" type="text" placeholder="{{ __('user.user_email') }}">

      <input name="password" value="" type="password" placeholder="{{ __('user.user_password') }}">

      <input value="{{ __('user.user_login') }}" name="{{ __('user.user_login') }}" type="submit" class="common_btn bottom_hover">

      <div class="no_login">
        <a href="resetpassword">{{ __('user.user_cantlogin') }}</a>

        <a href="register/create">{{ __('user.user_create_account') }}</a>
      </div>

      <p class="logout"><a href="/logout">{{ __('user.user_logout') }}</a></p>

    </form>

    <div class="sns_login">
      <p>SNSでログインする</p>
      <div class="sns_login_btn">
        <a href="auth/login/facebook" class="facebook">Facebook</a>
        <a href="auth/login/twitter" class="twitter">Twitter</a>
      </div>
    </div>

  </div>






  @include('components.footer')
</body>
</html>
