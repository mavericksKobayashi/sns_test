//
// キーワード検索
//
var myMap;
var service;
var marker;
var MarkerArray = new google.maps.MVCArray();

// 入力キーワードと表示範囲を設定
function SearchGo() {

  // 未入力は無視
  if($('#search_word').val() == ''){
    return false;
  }

  // マップをあらためて表示
  $('#map').show();

  // value値クリア
  $('#place_lat').val('');
  $('#place_lng').val('');
  $('#place_name').val('');

  $('#place_text .text').text('');


  var initPos = new google.maps.LatLng(0,0);

  var mapOptions = {
    center : initPos,
    zoom: 15,
    mapTypeId : google.maps.MapTypeId.ROADMAP
  };

  myMap = new google.maps.Map(document.getElementById("map"), mapOptions);
  service = new google.maps.places.PlacesService(myMap);

  // 入力されたキーワードを検索条件に設定
  var myword = document.getElementById("search_word");
  var request = {
    query : myword.value,
    radius : 5000,
    location : myMap.getCenter()
  };
  service.textSearch(request, result_search);


  // マップをクリックで位置変更
  myMap.addListener('click', function(e) {
    getClickLatLng(e.latLng, myMap, e.placeId);
  });
  function getClickLatLng(lat_lng, map, placeId) {

    if(placeId){

      // placeIdからプレイス検索
      var request = {
        placeId: placeId,
        fields: ['name', 'rating', 'formatted_phone_number', 'geometry']
      };
      service = new google.maps.places.PlacesService(map);
      service.getDetails(request, callback);
      function callback(place, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {

          // 名前：valueセット
          $('#place_name').val(place.name);

          // 名前：表示セット
          $('#place_text .text').text(place.name);

          // 緯度経度：valueセット
          $('#place_lat').val(lat_lng.lat());
          $('#place_lng').val(lat_lng.lng());

          //alert(place.name);
          //alert(lat_lng.lat());
          //alert(lat_lng.lng());


          // マーカーを設置
          
          // シングルマーカー削除
          if (typeof marker !== 'undefined') {
            marker.setMap(null);
          }
          
          // 複数マーカー削除
          MarkerArray.forEach(function (marker, idx) { marker.setMap(null); });

          marker = new google.maps.Marker({
            position: lat_lng,
            map: map,
            icon: {
              url: '/img/map_icon.png',
              scaledSize : new google.maps.Size(50, 50)
            }
          });


          // 検索窓クリア
          $('#search_word').val('');

        }
      }

    }
  
    // 座標の中心をずらす
    map.panTo(lat_lng);
  }

}


// 検索結果
function result_search(results, status) {

  var bounds = new google.maps.LatLngBounds();
  for(var i = 0; i < results.length; i++){
    var place = results[i];
    var name = results[i].name;
    var Marker = new google.maps.Marker({
      position : results[i].geometry.location,
      text : name,
      map : myMap,
      url: '/img/map_icon.png',
      icon: {
        url: '/img/map_icon.png',
        scaledSize : new google.maps.Size(70, 70)
      }
    });
    MarkerArray.push(Marker);

    Marker.addListener('click', function(e) {
      getClickMarker(e.latLng,name);
    });

    bounds.extend(results[i].geometry.location);
  }

  myMap.fitBounds(bounds);
}


function getClickMarker(lat_lng,name) {

  //alert(lat_lng);

  //　マップにマーカーを表示する

  // シングルマーカー削除
  if (typeof marker !== 'undefined') {
    marker.setMap(null);
  }
  
  // 複数マーカー削除
  MarkerArray.forEach(function (marker, idx) { marker.setMap(null); });

  var marker = new google.maps.Marker({
    map : myMap,
    position : lat_lng,   // 緯度・経度
    icon: {
    url: '/img/map_icon.png',
    scaledSize : new google.maps.Size(50, 50)
    }
  });

  MarkerArray = new google.maps.MVCArray();
  MarkerArray.push(marker);
  marker.addListener('click', function(e) {
    getClickMarker(e.latLng);
  });



  // 名前：valueセット
  $('#place_name').val(name);

  // 名前：表示セット
  $('#place_text .text').text(name);

  // 緯度経度：valueセット
  $('#place_lat').val(lat_lng.lat());
  $('#place_lng').val(lat_lng.lng());


  // 座標の中心をずらす
  myMap.panTo(lat_lng);
}



// マーカー表示
/*
function createMarker(options) {

  // マップ情報を保持しているmyMapオブジェクトを指定
  options.map = myMap;

  // Markcrクラスのオブジェクトmarkerを作成
  marker = new google.maps.Marker(options);

  // 各施設の吹き出し(情報ウインドウ)に表示させる処理
  var infoWnd = new google.maps.InfoWindow();
  infoWnd.setContent(options.text);
  
  // addListenerメソッドを使ってイベントリスナーを登録
  google.maps.event.addListener(marker, 'click', function(){
    //infoWnd.open(myMap, marker);

    var response = this.getPosition() ;

    // 緯度経度：valueセット
    $('#place_lat').val(response.lat());
    $('#place_lng').val(response.lng());

    // 名前：valueセット
    $('#place_name').val(this.text);

    // 名前：表示セット
    $('#place_text .text').text(this.text);

    //alert(response.lat());
    //alert(response.lng());
    //alert(this.text);
    
  });

  return marker;
}
*/


// 検索ボタンでキーワード検索開始
$('#search_button').on('click',function(){
  SearchGo();
});
// 入力後エンターキーで検索開始
$('#search_word').keypress(function(e) {
  if(e.which == 13) {
    SearchGo();
  }
});


// 初期化
$('.create_post_place .icon').on('click',function(){
  initMap();
});