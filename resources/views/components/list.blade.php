        <ul>
          @foreach($posts as $post)

          @php
            // サムネイル
            $post_images = $post->post_image()->first();
            if($post_images){
              $order_num = $post_images->order_num;
              $extension = 'jpg';
              if($post_images->type == 'image/png'){
                $extension = 'png';
              }
              $thumb_path = 'uploads/'.$post->user_id.'/post_'.$post->id.'_'.$order_num.'_thumb.'.$extension;
            } else {
              // データベースに画像データがない
              $thumb_path = 'img/no_image_post.png';
            }

            // カテゴリー
            $category_name_flag = false;
            if($post->category > 0){
              $category_name_flag = true;
              $category_name = $post->post_category()->first()->name;
              $category_name_en = $post->post_category()->first()->name_en;
            }
          @endphp

          <li>
            <a href="/post/{{$post->id}}">

              <div class="clip_img">
                @if(File::exists($thumb_path))
                <img src="{{ asset($thumb_path) }}" alt="" class="object-fit">
                @else
                <img src="{{ asset('img/no_image_post.png') }}" class="object-fit img_round">
                @endif
              </div>

              <div class="clip_txt">
                <p class="clip_place">{{$post->place}}</p>

                @if($category_name_flag)
                @foreach (Config::get('languages') as $lang => $language)
                  @if ($lang != App::getLocale())
                    @if ($lang == 'ja' )
                    <span class="clip_country">{{$category_name_en}}</span>
                    @else
                    <span class="clip_country">{{$category_name}}</span>
                    @endif
                  @endif
                @endforeach
                @endif
                <p class="clip_hash">#{{$post->post_user()->first()->nickname}}</p>
              </div>

            </a>
          </li>
          @endforeach

        </ul>


        <div class="pager">{{ $posts->links() }}</div>
