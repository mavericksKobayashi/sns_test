$(function(){

  var view_id = $('#view_id').text();

  // フォロー解除
  $('.follow_btn.active').click(function(){
    if(confirm('フォロー解除')){
      $(this).removeClass('active');
      $(this).addClass('inactive');
      $(this).text('フォローする');

      var clicked_id = $(this).siblings('.user').find('.my_user_id').text();
      
      var followForm = $('#followForm');

      if($(this).hasClass('osusume')){
        followForm.attr('action', '/register/follow');
      } else if($(this).hasClass('user_page')){
        followForm.attr('action', '/user/'+view_id);
      } else {
        if($('.tab .follower a')[0]){
          //　フォロー
          followForm.attr('action', '/user_follow/'+view_id);
        } else {
          //　フォロワー
          followForm.attr('action', '/user_follower/'+view_id);
        }
      }
      
      $('<input>').attr({'type':'hidden','name':'do_follow','value':'unfollow'}).appendTo(followForm);
      $('<input>').attr({'type':'hidden','name':'nm_follow','value':clicked_id}).appendTo(followForm);

      // Form送信
      followForm.submit();
    }
  });


  // フォローする
  $('.follow_btn.inactive').click(function(){
    $(this).removeClass('inactive');
    $(this).addClass('active');
    $(this).text('フォロー中');

    var clicked_id = $(this).siblings('.user').find('.my_user_id').text();
    
    var followForm = $('#followForm');

    if($(this).hasClass('osusume')){
      followForm.attr('action', '/register/follow');
    } else if($(this).hasClass('user_page')){
      followForm.attr('action', '/user/'+view_id);
    } else {
      if($('.tab .follower a')[0]){
        //　フォロー
        followForm.attr('action', '/user_follow/'+view_id);
      } else {
        // フォロワー
        followForm.attr('action', '/user_follower/'+view_id);
      }
    }
    
    $('<input>').attr({'type':'hidden','name':'do_follow','value':'follow'}).appendTo(followForm);
    $('<input>').attr({'type':'hidden','name':'nm_follow','value':clicked_id}).appendTo(followForm);

    // Form送信
    followForm.submit();
  });

});
