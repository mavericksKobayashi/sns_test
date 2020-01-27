$(function() {
  $('.admin_head > a').on('click', function(e) {
    e.preventDefault();
    $('.logout').toggleClass('show');
  });
  $('.sidebar_line li a').on('click', function(e) {
    e.preventDefault();
    $('.sidebar_line li').removeClass('active');
    $(this).parent('li').addClass('active');
    if($('.active').hasClass('desc')){
      $('.admin_list').css('flex-flow','column wrap');
    } else {
      $('.admin_list').css('flex-flow','column-reverse wrap');
    }
  });
});
$(function(){
  setTimeout(function() {
    $('.g_file_mask').on('click',function(){
      $('#file_01').trigger('click');
    });
    // プレビュー
    $('#file_01').on('change', function (e) {
      var reader = new FileReader();
      var preview_target = '.user_icon img';
      reader.onload = function (e) {
        $(preview_target).attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
    });
  }, 200);
});
