$(function(){

  // ポストID
  var post_id = $('#post_id').text();

  // ポストユーザーID
  var post_user = $('#post_user').text();

  // スクロールポジション
  var scr_pos = $('#scr_pos').text();
  $(window).scrollTop(scr_pos);
  $('body').css('opacity',1);


  var replaceWidth = 750;
  var windowWidth = parseInt($(window).width());
  
  /*
  if(windowWidth > replaceWidth) {
    $('.map_area').prependTo('#post_side_menu');
  } else {
    $('.map_area').prependTo('#map_area');
  };

  $(window).on('resize', function() {
    var windowWidth = parseInt($(window).width());
    if(windowWidth > replaceWidth) {
      $('.map_area').prependTo('#post_side_menu');
    } else {
      $('.map_area').prependTo('#map_area');
    };
  });
  */



  // ログイン済み、自分の投稿ではない場合でのいいね&ブックマークボタン
  if($('body.logined')[0] && !$('#my_post')[0]){
    $('.text_area .btn_area .icon').addClass('logined');

    $('.btn_area .icon.like').on('click',function(){
      pos = document.documentElement.scrollTop || document.body.scrollTop;

      window.location.href = '/add_like/' + post_id + '/' + post_user + '/' + pos;
    });

    $('.btn_area .icon.bookmark').on('click',function(){
      pos = document.documentElement.scrollTop || document.body.scrollTop;

      window.location.href = '/add_bookmark/' + post_id + '/' + post_user + '/' + pos;
    });
  }




});
