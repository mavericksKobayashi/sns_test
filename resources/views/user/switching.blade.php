@include('components.header')
<link href="{{ asset('css/follow.css') }}" rel="stylesheet">
<link href="{{ asset('css/message.css') }}" rel="stylesheet">
<script src="{{ asset('js/block_message.js') }}" defer></script>

</head>

<body id="message_switching" class="message">
  @include('components.menu')

  <p id="view_id">{{$user_id}}</p>

  <div class="cont">
    <div class="tab">
      <div class="inner">
        <a href="/user_message" class="back"></a>
        <p>{{$message_user_nickname}}</p>
        <form name="messageForm" id="messageForm" accept-charset="utf-8" method="post">
          {{ csrf_field() }}
          <a href="javascript:void(0);" class="follow_btn inactive user">{{ __('user.user_to_block') }}</a>
        </form>
      </div>
    </div>


    <div class="comment_area">
      @if (isset($messages[0]))
      @foreach ($messages as $message)

      @php
        if(is_null($message->updated_at)){
          $date = '';
        } else {
          $date = $message->updated_at->format('Y.n.j');
        }
      @endphp

        @if (isset($message->receiver))
        @if($message->user_id == $user_id)
        <div class="contributor">
          <div class="comment_box">
            <p class="comment">{!! nl2br($message->message_cont) !!}</p>
            @if($date != '')
            <p class="date">{{$date}}</p>
            @endif
          </div>
          <div class="user_icon">
            <a href="/user/{{$message->user_id}}">
              @php $thumb_path = 'uploads/'.$message->user_id.'/user_profile.jpg'; @endphp
              @if(File::exists($thumb_path))
              <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
              @else
              <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
              @endif
            </a>
          </div>
        </div>
        @else
        <div class="etcetera">
          <div class="user_icon">
            <a href="/user/{{$message->user_id}}">
              @php $thumb_path = 'uploads/'.$message->user_id.'/user_profile.jpg'; @endphp
              @if(File::exists($thumb_path))
              <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
              @else
              <img src="{{ asset('img/no_user_profile.png') }}" class="object-fit">
              @endif
            </a>
          </div>
          <div class="comment_box">
            <p class="comment">{!! nl2br($message->message_cont) !!}</p>
            @if($date != '')
            <p class="date">{{$date}}</p>
            @endif
          </div>
        </div>
        @endif
        @endif

      @endforeach
      @else
        <div class="no_hit">{{ __('user.user_no_message_ex') }}</div>
      @endif
    </div>

    @if (isset( $user ))
    <div class="comment_input">
      <form id="comment_form" name="comment_form">
        {{ csrf_field() }}
        <textarea type="textarea" name="message_cont" value="" placeholder="{{ __('user.user_enter_message') }}"></textarea>
        <a href="javascript:void(0);" class="bottom_hover">{{ __('user.user_send') }}</a>
      </form>
    </div>
    <script>
      $('#comment_form a').on('click',function(){
        if($('#comment_form textarea').val() != ''){
          var submitForm = $('#comment_form');
          var url_cut = location.href.split('user_message/');
          var message_user_id = url_cut[1];
          var actionURL = '/add_message/'+message_user_id;
          submitForm.attr('action', actionURL);
          submitForm.submit();
        }
      });
    </script>
    @endif
  </div>


  @include('components.footer')
</body>
</html>
