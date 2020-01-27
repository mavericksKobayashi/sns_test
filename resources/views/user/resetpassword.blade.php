@include('components.header')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

</head>

<body id="resetpassword">
  @include('components.menu')


  <div class="cont">

    <h1 class="auth_ttl">{{ __('user.user_reissue) }}</h1>

    @isset($message)
      <p class="errorMsg"><span>{{ $message }}</span></p>
    @endisset

    @foreach ($errors->all() as $error)
      <p class="errorMsg"><span>{{ $error }}</span></p>
    @endforeach



    <form action="/resetpassword" accept-charset="utf-8" method="post">

      {{ csrf_field() }}

      <input autofocus="autofocus" name="email" value="" type="text" placeholder="{{ __('user.user_email) }}">

      <input value="{{ __('user.user_send) }}" name="{{ __('user.user_send) }}" type="submit" class="common_btn bottom_hover">

      <div class="attention">
        {{ __('user.user_temporary_pw) }}
      </div>

      <div class="no_login">
        <a href="login">{{ __('user.user_login) }}</a>

        <a href="registry">{{ __('user.user_create_account) }}</a>
      </div>

      <p class="logout"><a href="/logout">{{ __('user.user_logout) }}</a></p>

    </form>

  </div>


  @include('components.footer')
</body>
</html>
