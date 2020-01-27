
  <div class="category">
    <h4 class="ttl">
      {{ __('components.side_category') }}
    </h4>
    <ul>
      @foreach($category_names as $category_name)
      <li>
        @foreach (Config::get('languages') as $lang => $language)
          @if ($lang != App::getLocale())
            @if ($lang == 'ja' )
            <a href="/category/{{$category_name->name}}">{{$category_name->name_en}}</a>
            @else
            <a href="/category/{{$category_name->name}}">{{$category_name->name}}</a>
            @endif
          @endif
        @endforeach
      </li>
      @endforeach
    </ul>
  </div>
  <div class="tags">
    <h4 class="ttl">
      {{ __('components.side_tag') }}
    </h4>
    <ul>
      @foreach($tag_names as $tag_name)
      <li>
        <a href="/tag/{{$tag_name}}">{{$tag_name}}</a>
      </li>
      @if($loop->index == 5)
        @php break; @endphp
      @endif
      @endforeach
    </ul>
  </div>
