$(function() {

  // 編集用
  if($('.file.set')[0]){

    // 削除用の配列
    var remove_order_arr = [];
    $('#remove_order_arr').val(remove_order_arr);

    $('.file.set').each(function (e) {

      // 削除用
      $(this).siblings('.stored').on('click',function(){
        if(confirm('削除してよろしいですか？')){

          $(this).parent().find('.object-fit').remove();
          $(this).parent().find('.add').show();
          $(this).parent().find('.file').val(null);
          $('#main_image').append($(this).parent());

          $(this).parent().hide();
          if($(this).parent().prev().find('.add').css('display')=='none'){
            $(this).parent().css('display','inline-block');
          }

          // order_numを配列に格納→post
          var date_order = $(this).data('order');
          remove_order_arr.push(date_order);
          $('#remove_order_arr').val(remove_order_arr);

          $(this).remove();
          return false;

        } else {
          return false;
        }
      });

    });
  }



  // メイン画像入力
  $('.file').on('change', function (e) {

    // 削除用
    $(this).before('<p class="stored"></p>');
    $(this).siblings('.stored').on('click',function(){
      $(this).parent().find('.object-fit').remove();
      $(this).parent().find('.add').show();
      $(this).parent().find('.file').val(null);
      $('#main_image').append($(this).parent());

      $(this).parent().hide();
      if($(this).parent().prev().find('.add').css('display')=='none'){
        $(this).parent().css('display','inline-block');
      }

      $(this).remove();
      return false;
    });

    $(this).next().hide();
    var target = $(this);

    var reader = new FileReader();
    reader.onload = function(e) {
      // サムネイル表示
      $(target).after('<img src="'+ e.target.result +'" alt="" class="object-fit">');

      // input 設定
      $(this).val(e.target.result);
    };
    reader.readAsDataURL(e.target.files[0]);

    $(target).parent().next().css('display','inline-block');

  });



  // 評価
  $('input[type=range]').change(rangeGauge);
  function rangeGauge() {
    $('.range_btn_giji').hide();
    var val = $(this).val();
    $('.create_post_goodness .range').val(val);

    if (val == 1) {
      $('.range_btn_giji01, .range_btn_giji02').show();
      $(this).removeClass();
      $(this).addClass('range');
      $(this).addClass('rating_1');
    } else if (val == 2) {
      $('.range_btn_giji02').show();
      $(this).removeClass();
      $(this).addClass('range');
      $(this).addClass('rating_2');
    } else if (val == 3) {
      $(this).removeClass();
      $(this).addClass('range');
      $(this).addClass('rating_3');
    }  else if (val == 4) {
      $('.range_btn_giji03').show();
      $(this).removeClass();
      $(this).addClass('range');
      $(this).addClass('rating_4');
    } else if (val == 5) {
      $('.range_btn_giji03, .range_btn_giji04').show();
      $(this).removeClass();
      $(this).addClass('range');
      $(this).addClass('rating_5');
    }
  }



  // 公開設定
  if($('#my_pub')[0]){
    if($('#my_pub').text() > 0){
      $('#public').prop('checked', true);
    } else {
      $('#public').prop('checked', false);
    }
  }



  // クチコミ
  var text_max = 1200; // 最大入力値
  $('.kuchikomi_count').text(text_max - $('#kuchikomi').val().length);

  $('#kuchikomi').on('keydown keyup keypress change',function(){
    text_count();
  });
  if($('body.edit')[0]){
    var kuchikomi = $('.create_post_kuchikomi textarea').text();
    $('.create_post_kuchikomi textarea').val(kuchikomi);
    text_count();
  }
  function text_count() {
    var text_length = $('#kuchikomi').val().length;
    $('.kuchikomi_count').text(text_length);
    if(text_length > 1200){
      $('.kuchikomi_count').css({
        color:'#ff0000',
        fontWeight:'bold'
      });
    } else {
      $('.kuchikomi_count').css({
        color:'#000000',
        fontWeight:'normal'
      });
    }
  }



  // タグ表示、削除
  if($('#tag_input')[0]){
    var tag_name_arr = [];

    // 編集画面用
    if($('#tag_edit')[0]){
      $('#tag_edit li').each(function(){
        var tag_txt = $(this).text();
        tag_enter(tag_txt);
      });
    }

    // エンターキーで決定
    $('#tag_input').keypress(function(e){
      if(e.which == 13){
        tag_enter();
      }
    });

    function tag_enter(tag_txt){

      if(tag_txt) {
        var tag_name = tag_txt;
      } else {
        tag_name = $('#tag_input').val();
      }

      if(tag_name != '' && $.inArray(tag_name, tag_name_arr) < 0){
        $('.create_post_tag .tags').append('<p><span>'+tag_name+'</span></p>');
        $('.create_post_tag').append('<input class="hidden_tag" type="hidden" name="tags[]" value="'+tag_name+'">');
        tag_name_arr.push(tag_name);
        $('#tag_input').val('');

        // 削除
        $('.create_post_tag .tags p').on('click',function(){

          var tag_name = $(this).text();

          for(i=0; i<tag_name_arr.length; i++){
            if(tag_name_arr[i] == tag_name){
              tag_name_arr.splice(i, 1);
            }
          }

          var hidden_length = $('.create_post_tag .hidden_tag').length;
          for(i=0; i<hidden_length; i++){
            if($('.create_post_tag .hidden_tag').eq(i).val() == tag_name){
              $('.create_post_tag .hidden_tag').eq(i).remove();
            }
          }

          $(this).remove();
        });
      }

    }
  }



  // 日付
  $(function() {
    $("#datepicker").datepicker();
    $("#datepicker").datepicker("option", "dateFormat", 'yy.m.d');

    // 編集画面用
    if($('#my_date')[0]){
      $("#datepicker").datepicker("setDate", $('#my_date').text());
    }
  });



  // 送信
  $('.create_post_submit').on('click',function(){

    // JS validate
    var js_error = '';
    if($('#place_name').val() == ''){
      js_error = '場所が設定されていません。<br>';
    }

    if($('#kuchikomi').val().length > 1200){
      js_error = js_error+'クチコミは1200文字までです。<br>';
    }

    if(js_error != ''){
      $('#js_error p').html(js_error);
      return false;
    }


    $('#create_form').submit();
  });


});
