@php
  // 新規作成：$mode == 'create'
  // 編集画面：$mode == 'edit'
  // bodyタグのクラスも振り分けている


  if($lang == 'en'){
    $place_text = 'Tap a facility in the map to confirm';
  } else {
    $place_text = '地図内の施設をタップして決定';
  }

@endphp


@include('components.header')
<link href="{{ asset('css/create.css') }}" rel="stylesheet">

</head>

@if($mode == 'create')
<body id="create" class="create">
@else
<body id="create" class="edit">
@endif

  @include('components.menu')


  <form id="create_form" method="POST" action="/create" enctype="multipart/form-data">
  {{ csrf_field() }}


  <div class="post_content">


    <div class="thumnail_sp sp"></div>


    <div class="inner">
      <div class="create_post other_content">


        <input type="hidden" name="mode" value="{{$mode}}">

        @isset($post_id)
        <input type="hidden" name="post_id" value="{{$post_id}}">
        @endisset

        @if($mode == 'edit')
        <input id="remove_order_arr" type="hidden" name="remove_order_arr" value="">
        @endif


        @if(!empty($errors))
        <div class="errorMsg">
          @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach
        </div>
        @endif



        <!-- イメージ -->
        <div id="main_image">

          @if($mode == 'create')

            @for ($i = 1; $i <= 10; $i++)
              <label class="file_mask">
                <input type="file" name="file[]" class="file">
                <p class="add"><img src="/img/icon_upload.svg"></p>
              </label>
            @endfor

          @else

            @foreach ($my_mains as $my_main)

              @php
                // 拡張子判定
                $mime_type = $my_main->mimetype;
                switch($mime_type){
                  case 'image/jpeg':
                    $img_extension = "jpg";
                    break;
                  case 'image/png':
                    $img_extension = "png";
                    break;
                  case 'image/gif':
                    $img_extension = "gif";
                    break;
                }

                $file_name_thumb = 'post_' . $post_id . '_' . $my_main->order_num . '_thumb.' . $img_extension;
                $file_fullpath = '/uploads/'.$user_id.'/'.$file_name_thumb;

              @endphp

              <label class="file_mask" style="display: inline-block;">
                <p class="stored" data-order="{{$my_main->order_num}}"></p>
                <input type="file" name="edit[]" class="file set">
                <img src="{{ $file_fullpath }}" alt="" class="object-fit">
                <p class="add" style="display: none;"><img src="/img/icon_upload.svg"></p>
              </label>

            @endforeach

            @for ($i = 1; $i <= $my_mains_remain; $i++)
              @if($i == 1)
              <label class="file_mask" style="display: inline-block;">
              @else
              <label class="file_mask">
              @endif
                <input type="file" name="file[]" class="file">
                <p class="add"><img src="/img/icon_upload.svg"></p>
              </label>
            @endfor

          @endif

        </div>



        <!-- 場所 -->
        <div class="create_post_place">
          <input type="text" placeholder="{{ __('create.search_word') }}" id="search_word">
          <img src="/img/icon_location.svg" class="icon">
        </div>
        <input id="search_button" type="button" value="{{ __('create.search') }}">

        <div id="map"></div>

        @if($mode == 'create')
          <div id="place_text">
            <p id="place_text_default" class="disp_non">{{$place_text}}</p>
            <p><em>{{ __('create.place') }}：</em><span class="text">{{$place_text}}</span></p>
            <input type="hidden" value="">
          </div>

          <input type="hidden" name="place" id="place_name" value="">
          <input type="hidden" name="lat" id="place_lat" value="">
          <input type="hidden" name="lng" id="place_lng" value="">
        @else
          <div id="place_text">
            <p><em>{{ __('create.place') }}：</em><span class="text">{{$my_place}}</span></p>
            <input type="hidden" value="">
          </div>

          <input type="hidden" name="place" id="place_name" value="{{$my_place}}">
          <input type="hidden" name="lat" id="place_lat" value="{{$my_lat}}">
          <input type="hidden" name="lng" id="place_lng" value="{{$my_lng}}">
        @endif



        <!-- クチコミ -->
        <div class="create_post_kuchikomi">
          @if($mode == 'create')
          <textarea name="kuchikomi" id="kuchikomi" placeholder="{{ __('create.enter_review') }}"></textarea>
          @else
          <textarea name="kuchikomi" id="kuchikomi" placeholder="{{ __('create.enter_review') }}">{{ $my_contents }}</textarea>
          @endif
          <p><span class="kuchikomi_count">0</span>/1200</p>
        </div>



        <!-- タグ -->
        <div class="create_post_tag">
          <input id="tag_input" type="text" name="tag" placeholder="{{ __('create.enter_tag') }}">
          <div class="tags"></div>
        </div>
        @isset($my_tags)
        <ul id="tag_edit" class="disp_non">
        @foreach($my_tags as $my_tag)
          <li>{{ $my_tag->name }}</li>
        @endforeach
        </ul>
        @endisset



        <!-- カテゴリー -->
        <div class="create_post_category">

          <div class="create_post_category01">
            <select name="category" class="cp_sl" >
              @if($my_category == '')
                <option value="" hidden disabled selected>{{ __('create.select_category') }}</option>
              @endif
              @foreach($categories as $category)
              @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                  @if ($lang == 'ja' )
                  @if($my_category == $category->name)
                    <option value="{{$category->id}}" selected>{{$category->name_en}}</option>
                  @else
                    <option value="{{$category->id}}">{{$category->name_en}}</option>
                  @endif
                  @else
                  @if($my_category == $category->name)
                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                  @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endif
                  @endif
                @endif
              @endforeach
              @endforeach
            </select>
          </div>



          <!-- 訪問日 -->
          <div class="create_post_category02">
            <input name="date" type="text" id="datepicker" class="cp_sl" placeholder="{{ __('create.select_date') }}" autocomplete="off">
          </div>
          @isset($my_date)
          @if($my_date != '')
            <p id="my_date" class="disp_non">{{$my_date}}</p>
          @endif
          @endisset

        </div>



        <!-- 評価 -->
        <div class="good_public">
          <div class="create_post_goodness_wrap">
            <p>{{ __('create.rate') }}</p>
            <div class="create_post_goodness">
              <input type="range" name="rate" class="range" min="1" max="5" step="1" value="3">
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

          @if($mode == 'edit')
            <script>
              $(function(){
                $('.create_post_goodness input').val({{ $my_rate }});
              });
          </script>
          @endif



          <!-- 公開設定 -->
          <div class="public_btn_wrap">
            @if($post_freeze == 1)
            @else
            <span>{{ __('create.publishing_settings') }}</span>
            <div class="public_btn_area">
              <p>{{ __('create.publish') }}</p>
              <div class="public_btn">
                @if($mode == 'create')
                <input type="checkbox" name="public" id="public" data-index="0" checked="checked">
                @else
                  @if($my_pub > 0)
                  <input type="checkbox" name="public" id="public" data-index="0" checked="checked">
                  @else
                  <input type="checkbox" name="public" id="public" data-index="0" checked="">
                  @endif
                @endif
                <label for="public"></label>
              </div>
            </div>
            @endif
          </div>
        </div>

        @if($mode == 'edit')
        <p id="my_pub" class="disp_non">{{$my_pub}}</p>
        @endif


        <div id="js_error">
          <p></p>
        </div>



        <!-- 投稿ボタン -->
        @if($mode == 'create')
        <p class="create_post_submit bottom_hover">{{ __('create.do_post') }}</p>
        @else
        <p class="create_post_submit bottom_hover">{{ __('create.update') }}</p>
        @endif
        <!--<p class="create_post_save sp"><a href="">{{ __('create.draft') }}</a></p>-->


      </div>
    </div>
  </div>

  </form>


  @include('components.footer')


  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/eggplant/jquery-ui.css" >
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
  <script src="../js/create.js"></script>

  <script src="../js/create_initmap.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54OWFXnwA-VKgHS1T28AZvcEs7nBh964&callback=initMap&libraries=places"></script>
  <script src="../js/create_search.js"></script>

</body>
</html>
