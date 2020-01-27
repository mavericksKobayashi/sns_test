@include('components.header')
<link href="{{ asset('css/follow.css') }}" rel="stylesheet">
<link href="{{ asset('css/message.css') }}" rel="stylesheet">
<script src="{{ asset('js/block_message.js') }}" defer></script>

</head>

<body id="message" class="message">
  @include('components.menu')

  <p id="view_id">{{$user_id}}</p>

  <div class="cont">
    <div class="tab">
      <div class="follow">
        <a href="/user_message/">{{ __('user.user_message') }}</a>
        <p>{{ __('user.user_blocklist') }}</p>
      </div>
    </div>

    <form name="messageForm" id="messageForm" accept-charset="utf-8" method="post">

      {{ csrf_field() }}

      <ul class="message">
        @if (isset($messages[0]))
        @foreach ($messages as $message)

          @if (isset($message->receiver))
          @if ($user_id == $message->receiver->id)
          <li class="user_message">
            <div class="user">
              <a href="/user/{{$message->transmitter->id}}">
                <div class="user_icon">
                  <div class="img">
                    @php $thumb_path = 'uploads/'.$message->user_id.'/user_profile.jpg'; @endphp
                    @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                    @else
                    <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                    @endif
                  </div>
                  <div class="text">
                    <p class="my_user_id">{{$message->user_id}}</p>
                    <p class="user_name">{{$message->transmitter->nickname}}</p>
                    <p class="user_place">{{$message->transmitter->place}}</p>
                  </div>
                </div>
              </a>
            </div>
            <a href="javascript:void(0);" class="follow_btn active user">{{ __('user.user_unblock') }}</a>
          </li>
          @else
          <li class="user_message">
            <div class="user">
              <a href="/user/{{$message->receiver->id}}">
                <div class="user_icon">
                  <div class="img">
                    @php $thumb_path = 'uploads/'.$message->receiver->id.'/user_profile.jpg'; @endphp
                    @if(File::exists($thumb_path))
                    <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                    @else
                    <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
                    @endif
                  </div>
                  <div class="text">
                    <p class="my_user_id">{{$message->receiver->id}}</p>
                    <p class="user_name">{{$message->receiver->nickname}}</p>
                    <p class="user_place">{{$message->receiver->place}}</p>
                  </div>
                </div>
              </a>
            </div>
            <a href="javascript:void(0);" class="follow_btn active user">{{ __('user.user_unblock') }}</a>
          </li>
          @endif
          @endif
        @endforeach
        @else
          <li class="no_hit">{{ __('user.user_not_blocking') }}</li>
        @endif
      </ul>
    </form>
  </div>


  @include('components.footer')
</body>
</html>
