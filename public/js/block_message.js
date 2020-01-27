$(function(){

  var view_id = $('#view_id').text();

  // ブロック解除
  $('.follow_btn.active').click(function(){
      var clicked_id = $(this).siblings('.user').find('.my_user_id').text();

      var messageForm = $('#messageForm');

      $('<input>').attr({'type':'hidden','name':'do_block','value':'unfollow'}).appendTo(messageForm);
      $('<input>').attr({'type':'hidden','name':'nm_block','value':clicked_id}).appendTo(messageForm);

      // Form送信
      messageForm.submit();
  });


  // ブロックする
  $('.follow_btn.inactive').click(function(){
    var url_cut = location.href.split('user_message/');

    var clicked_id = url_cut[1];

    var messageForm = $('#messageForm');

    $('<input>').attr({'type':'hidden','name':'do_follow','value':'follow'}).appendTo(messageForm);
    $('<input>').attr({'type':'hidden','name':'nm_block','value':clicked_id}).appendTo(messageForm);

    // Form送信
    messageForm.submit();
  });

});
