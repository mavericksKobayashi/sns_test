<!-- <div class="sidebar_filter">
  <h3><img src="../img/icon_filter01.svg" alt="">フィルター</h3>
  <form action="">
    <div class="filter_sex_wrap">
      <select name="" id="filter_sex">
        <option value="" style="display: none;">性別</option>
        <option value="">男性</option>
        <option value="">女性</option>
        <option value="">指定なし</option>
      </select>
    </div>
    <div class="filter_place_wrap">
      <select name="" id="filter_place">
        <option value="">国内</option>
        <option value="">国外</option>
      </select>
    </div>
    <input type="reset" class="filter_reset">
  </form>
</div> -->
<div class="sidebar_line">
  <h3><img src="../img/icon_filter02.svg" alt="">並び替え</h3>
    <form class="" action="{{request()->fullUrl()}}">
      <ul>
        <li class="desc active"><a href="">最新</a></li>
        <li class="asc"><a href="">古いものから</a></li>
      </ul>
    </form>
</div>
