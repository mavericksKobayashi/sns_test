<header id="header">
  <div class="header_menu">
    <h1 class="logo"><img src="{{ asset('img/logo.svg') }}" alt="FLIP"></h1>
    <div class="header_btn_pc">
      <div id="menu_pc">
        <ul>
          <li>
            <div class="search_box">
              <input type="text" name="search" value="" placeholder="{{ __('components.menu_search') }}">
            </div>
          </li>
          <li>
            <a href="#" class="contribution">{{ __('components.menu_newPost') }}</a>
          </li>
          <li>
            <a href="#" class="ranking">{{ __('components.menu_ranking') }}</a>
          </li>
          <li>
            <a href="#" class="bookmark">{{ __('components.menu_bookmarks') }}</a>
          </li>
          <li>
            <a href="#" class="news">{{ __('components.menu_news') }}</a>
          </li>
        </ul>
      </div>
      <div class="header_btn">
        <a href="#" class="bg_gray">LOGIN</a>
        <a href="about" class="bg_orange">ABOUT</a>
      </div>
    </div>
  </div>
</header>

<div id="menu">
  <ul>
    <li>
      <a href="#" class="home active"></a>
    </li>
    <li>
      <a href="#" class="ranking"></a>
    </li>
    <li>
      <a href="#" class="contribution"></a>
    </li>
    <li>
      <a href="#" class="bookmark"></a>
    </li>
    <li>
      <a href="#" class="search"></a>
    </li>
  </ul>
</div>
