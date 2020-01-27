@include('components.header')
<link href="{{ asset('css/follow.css') }}" rel="stylesheet">
<link href="{{ asset('css/notice.css') }}" rel="stylesheet">

</head>

<body id="notice" class="notice">
  @include('components.menu')

  <div class="cont">
    <ul>
      @if (isset($news_lists[0]))
      @foreach ($news_lists as $news_list)
      <li>
        <div class="user">
          <a href="/news/{{ $news_list->id }}">
            <div class="user_icon">
              <div class="img">
                <img src="{{ asset('img/flip_news.png') }}" class="object-fit">
              </div>
              <div class="text">
                <p class="notice_name">{{ $news_list->title }}</p>
                <p class="notice_ago" date-at="{{ $news_list->updated_at->timestamp }}"></p>
              </div>
            </div>
          </a>
        </div>
      </li>
      @endforeach
      @endif
    </ul>
  </div>


  @include('components.footer')
</body>
<script>
// 経過時間要素を作成（更新）する
function createTimeZoneStr (milliseconds) {

    let dateObj = new Date(milliseconds);
    let oclock = dateObj.getHours();
    // let timeZone = '';

    // if (oclock < 1) {
    //     timeZone = '夜';
    // } else if (oclock < 4) {
    //     timeZone = '深夜';
    // } else if (oclock < 7) {
    //     timeZone = '早朝';
    // } else if (oclock < 9) {
    //     timeZone = '朝';
    // } else if (oclock < 12) {
    //     timeZone = '午前';
    // } else if (oclock < 13) {
    //     timeZone = '昼';
    // } else if (oclock < 16) {
    //     timeZone = '午後';
    // } else if (oclock < 19) {
    //     timeZone = '夕方';
    // } else if (oclock < 24) {
    //     timeZone = '夜';
    // }
    //
    // return timeZone
}
function calcHhMm(milliSeconds) {

    let h = String(Math.floor(milliSeconds / (1000 * 60 * 60)) + 100).substring(1);
    let m = String(Math.floor((milliSeconds - h * (1000 * 60 * 60))/(1000 * 60))+ 100).substring(1);

    let t = {
        h: h,
        m: m
    }

    return t

}
function putStrFromNowToTheElems() {

    let nowDateObj = new Date();
    let nowTimestamp = nowDateObj.getTime();

    $('.notice_ago').each(function(){

        let postedAtTimestamp = Number($(this).attr('date-at')) * 1000;
        console.log(postedAtTimestamp);
        let today0AmDateObj = new Date();
        today0AmDateObj.setHours(0,0,0,0);
        let today0AmTimestamp = today0AmDateObj.getTime();
        let passedMilliSeconds = nowTimestamp - postedAtTimestamp;
        let fromNowStr = '';

        let periodOfTimeStr = createTimeZoneStr(postedAtTimestamp);

        if (postedAtTimestamp < today0AmTimestamp - (1000 * 60 * 60 * 24)) {

            fromNowStr = Math.ceil((today0AmTimestamp - postedAtTimestamp) / (1000 * 60 * 60 * 24));
            fromNowStr = '<span class="text-monospace">' + String(fromNowStr).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</span>日前';

        } else if (postedAtTimestamp < today0AmTimestamp) {

            if (passedMilliSeconds > 1000 * 60 * 60 * 26) {

                fromNowStr = '昨日';

            } else {

                let t = calcHhMm(passedMilliSeconds);
                fromNowStr = '<span class="text-monospace">' + t.h + '</span>時間<span class="text-monospace">' + t.m + '</span>分前';

            }

        } else if (passedMilliSeconds > 1000 * 60 * 60) {

            let t = calcHhMm(passedMilliSeconds);
            fromNowStr = '<span class="text-monospace">' + t.h + '</span>時間<span class="text-monospace">' + t.m + '</span>分前';

        } else if (passedMilliSeconds > 1000 * 60) {

            let t = calcHhMm(passedMilliSeconds);
            fromNowStr ='<span class="text-monospace">' + t.m + '</span>分前';

        } else {
            fromNowStr = '数秒前';
        }

        $(this).html(fromNowStr);
    });
}
putStrFromNowToTheElems();
</script>
</html>
