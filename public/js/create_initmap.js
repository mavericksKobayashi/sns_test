// initMap
function initMap() {

  // 新規作成画面用
  if($('body.create')[0]){

    $(function(){
      // 検索窓クリア
      $('#search_word').val('');

      $('#place_lat').val('');
      $('#place_lng').val('');
      $('#place_name').val('');

      // 名前：表示リセット
      var place_text_default = $('#place_text_default').text();;
      $('#place_text .text').text(place_text_default);
    });

    // Geolocation APIに対応している
    if (navigator.geolocation) {

      // 現在地を取得
      navigator.geolocation.getCurrentPosition(

        // 取得成功した場合
        function(position) {

          // 緯度・経度を変数に格納
          var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

          // マップオプションを変数に格納
          var mapOptions = {
            zoom : 18,          // 拡大倍率
            center : mapLatLng  // 緯度・経度
          };

          // マップオブジェクト作成
          var map = new google.maps.Map(
            document.getElementById("map"), // マップを表示する要素
            mapOptions         // マップオプション
          );

          //　マップにマーカーを表示する
          var marker = new google.maps.Marker({
            map : map,             // 対象の地図オブジェクト
            position : mapLatLng,   // 緯度・経度
            icon: {
            url: '/img/map_icon.png',
            scaledSize : new google.maps.Size(70, 70)
            }
          });



          // マップをクリックで位置変更
          map.addListener('click', function(e) {
            getClickLatLng(e.latLng, map, e.placeId);
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
                  if (typeof marker !== 'undefined') {
                    marker.setMap(null);
                  }
                  marker = new google.maps.Marker({
                    position: lat_lng,
                    map: map,
                    icon: {
                      url: '/img/map_icon.png',
                      scaledSize : new google.maps.Size(50, 50)
                    }
                  });


                }
              }

              /*
              // キーワードからプレイス検索
              var service = new google.maps.places.PlacesService(map);
              service.findPlaceFromQuery({
                query: 'マーベリックス　藤沢',
                fields: ['name', 'formatted_address', 'geometry', 'place_id']
              }, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                  for (var i = 0; i < results.length; i++) {
                    var place = results[i];
                    console.log(place);
                  }
                }
              });
              */


              // マーカーを設置
              /*
              marker.setMap(null);
              marker = new google.maps.Marker({
                position: lat_lng,
                map: map
              });
              */

            }
          
            // 座標の中心をずらす
            map.panTo(lat_lng);
          }
          

          // 情報ウィンドウを表示させない
          (function fixInfoWindow() {
            var set = google.maps.InfoWindow.prototype.set;
            google.maps.InfoWindow.prototype.set = function(key, val) {
              if (key === "map") {
                if (! this.get("noSuppress")) {
                  return;
                }
              }
              set.apply(this, arguments);
            }
          })();

        },

        // 取得失敗した場合
        function(error) {

          // エラーメッセージを表示
          switch(error.code) {
            case 1: // PERMISSION_DENIED
              alert("位置情報の利用が許可されていません");
              break;
            case 2: // POSITION_UNAVAILABLE
              alert("現在位置が取得できませんでした");
              break;
            case 3: // TIMEOUT
              alert("タイムアウトになりました");
              break;
            default:
              alert("その他のエラー(エラーコード:"+error.code+")");
              break;
          }

          // マップ非表示
          $('#map').hide();

        }
      );

    // Geolocation APIに対応していない
    } else {
      alert("この端末では位置情報が取得できません");

      // マップ非表示
      $('#map').hide();
    }

  }
  // ここまで新規作成画面用


  // 編集画面用
  if($('body.edit')[0]){

    $(function(){
      // 検索窓クリア
      $('#search_word').val('');
    });

    // 緯度・経度を変数に格納
    var my_lat = $('#place_lat').val();
    var my_lng = $('#place_lng').val();
    var mapLatLng = new google.maps.LatLng(my_lat, my_lng);

    // マップオプションを変数に格納
    var mapOptions = {
      zoom : 18,          // 拡大倍率
      center : mapLatLng  // 緯度・経度
    };

    // マップオブジェクト作成
    var map = new google.maps.Map(
      document.getElementById("map"), // マップを表示する要素
      mapOptions         // マップオプション
    );

    //　マップにマーカーを表示する
    var marker = new google.maps.Marker({
      map : map,             // 対象の地図オブジェクト
      position : mapLatLng,   // 緯度・経度
    });


    // マップをクリックで位置変更
    map.addListener('click', function(e) {
      getClickLatLng(e.latLng, map, e.placeId);
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

          }
        }

      }
    
      // 座標の中心をずらす
      map.panTo(lat_lng);
    }
    

    // 情報ウィンドウを表示させない
    (function fixInfoWindow() {
      var set = google.maps.InfoWindow.prototype.set;
      google.maps.InfoWindow.prototype.set = function(key, val) {
        if (key === "map") {
          if (! this.get("noSuppress")) {
            return;
          }
        }
        set.apply(this, arguments);
      }
    })();

  }
  // ここまで編集画面用

}