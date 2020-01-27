var lang = 'jp';


$(function(){
  $('#top .slid_view').slick({
    autoplay: true,
    autoplaySpeed:4000,
    dots:false,
    arrows:false,
    cssEase: 'ease',
    fade: true,
    speed: 3000,
  });
});

$(function(){
  $('.post_slide').slick({
    dots:true,
    arrows:false,
    responsive: [ {
      breakpoint: 9999,
      settings: {
        customPaging: function(slick,index) {
          // スライダーのインデックス番号に対応した画像のsrcを取得
          var targetImage = slick.$slides.eq(index).find('img').attr('src');
          // slick-dots > li　の中に上記で取得した画像を設定
          return '<div class="aspect"><img src=" ' + targetImage + ' " class="object-fit"/></div>';
        } ,
      }
    }, {
      breakpoint: 751,
      settings: {
      }
    },]
  });
});




$(function(){
  function reviews_slide() {
      $('.reviews_slide').not('.slick-initialized').slick({
        dots:false,
        arrows:true,
        infinite: false,
        slidesToShow:5,
        slidesToScroll:1,
        prevArrow: '<div class="prev-arrow"></div>',
        nextArrow: '<div class="next-arrow"></div>',
        responsive: [ {
            breakpoint: 1000,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 900,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          }, {
            breakpoint: 768,
            settings: 'unslick'
            // settings: {
            //   slidesToShow: 3,
            //   slidesToScroll: 1,
            // }
          }, ]
      });
  }
  reviews_slide();

  $(window).resize( function() {
    reviews_slide();
  });
});

/*------------------------------------
  SPとPCで画像の入れ替え
  画像変更対象の<img>にスタイル「switch」を追加する。
  画像の命名規則：最後に_pc,_spとする。
  ※スタイルはJSコントロール用でCSSに無し。
--------------------------------------*/

$(function() {
  // 置換の対象とするclass属性。
  var $elem = $('.switch');
  // 置換の対象とするsrc属性の末尾の文字列。
  var sp = '_sp.';
  var pc = '_pc.';
  // 画像を切り替えるウィンドウサイズ。
  var replaceWidth = 750;

  function imageSwitch() {
    // ウィンドウサイズを取得する。
    var windowWidth = parseInt($(window).width());

    // ページ内にあるすべての`.switch`に適応される。
    $elem.each(function() {
      var $this = $(this);
      // ウィンドウサイズが768px以上であれば_spを_pcに置換する。
      if(windowWidth >= replaceWidth) {
        $this.attr('src', $this.attr('src').replace(sp, pc));

      // ウィンドウサイズが768px未満であれば_pcを_spに置換する。
      } else {
        $this.attr('src', $this.attr('src').replace(pc, sp));
      }
    });
  }
  imageSwitch();

  // 動的なリサイズは操作後0.2秒経ってから処理を実行する。
  var resizeTimer;
  $(window).on('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      imageSwitch();
    }, 200);
  });
});

//ログイン時spメニュー
$(function(){
  $('.user_menu_btn').click(function(){
    if ($('#user_menu').hasClass('open')){
      $('#user_menu').removeClass('open')
    } else {
      $('#user_menu').addClass('open')
    }
  });

  $('#user_menu').click(function(){
    if ($('#user_menu').hasClass('open')){
      $('#user_menu').removeClass('open')
    };
  });
});

//メニュー
$(function(){
  $(window).scroll(function(){
    if($(this).scrollTop() > 20){
      $('#menu').css('top','50px');
    } else {
      $('#menu').css('top','-100px');
    }
  });
});

/*--------------------------------------
  smooth scroll
--------------------------------------*/

$(document).ready(function(){
  //URLのハッシュ値を取得
  var urlHash = location.hash;
  //ハッシュ値があればページ内スクロール
  if(urlHash) {
    //スクロールを0に戻す
    $('body,html').stop().scrollTop(0);
    setTimeout(function () {
      //ロード時の処理を待ち、時間差でスクロール実行
      scrollToAnker(urlHash) ;
    }, 100);
  }

  //通常のクリック時
  $('a[href^="#"]').click(function(){
    var speed = 1000;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    //ヘッダーの高さを取得
    var header = $('header').height();
    //ヘッダーの高さを引く
    var position = target.offset().top - header;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });

  // 関数：スムーススクロール
  // 指定したアンカー(#ID)へアニメーションでスクロール
  function scrollToAnker(hash) {
    var header = $('header').height();
    var target = $(hash);
    var position = target.offset().top - header;
    $('body,html').stop().animate({scrollTop:position}, 1000);
  }
});

//アコーディオン
$(function(){
  var windowWidth = $(window).width();
  if (windowWidth < 751){
    $('.accordion_ttl').click(function(){
      $(this).toggleClass('open');
        if($(this).hasClass('open')){
          $(this).next().slideDown(200);
        } else {
          $(this).next().slideUp(200);
        }
    });
  }
});

//flash_message
$(function(){
  $('.flash_message').addClass('flash_message_on');
  setTimeout(function(){
    $('.flash_message').removeClass('flash_message_on');
  },2000);
});

//初めてサイトにアクセス
$(function(){

  // クッキーリセット
  // $.removeCookie('access');
  // $.removeCookie('lang');


  // 言語設定
  if($.cookie("lang") == undefined) {
    //alert("言語未設定");
    $("#language").css("display","block");
  } else {
    //alert("言語設定済み");
    $("#language").css("display","none");
    $("#intro").css("display","block");
    // カテゴリ言語変換
    // cate_lang_change();
  }

  if($.cookie("access") != undefined) {
    // カテゴリ言語変換
    // cate_lang_change();

    $("#intro").css("display","none")
    $('body').addClass('view_start');
  }

  // イントロボタン
  $('#intro .common_btn').click(function(){
    $("#intro").css("display","none")
    $('body').addClass('view_start');
    $.cookie("access","onece");
  });


  $('#language .common_btn').click(function(){
    var change_link = $(this).attr('data-lang');

    // 言語切り替え
    var lang_text = $(this).text();

    if(lang_text == '日本語'){
      $.cookie('lang','jp');
    } else {
      $.cookie('lang','en');
    }

    setTimeout(function(){
      if(change_link != undefined){
        window.location.href = change_link;
      } else {
        window.location.href = '/';
      }
    },800);

  });

  // 言語設定
  setTimeout(function(){
    if($.cookie('lang') != undefined) {
      if($.cookie('lang') == 'en') {
        lang = 'en';
        $('body').removeClass('jp');
        $('body').addClass('en');
      } else {
        $('body').removeClass('en');
        $('body').addClass('jp');
      }
    }
  },100);


  // カテゴリ言語変換
  // cate_lang_change();

});


// Message close
$(function() {
  $("#intro .close").click(function(){
    $("#intro").css("display","none")
  });
  $("#language .close").click(function(){
    $("#language").css("display","none")
  });
});


// function cate_lang_change(){
//
//   setTimeout(function(){
//   // トップ　カテゴリー一覧
//   if($('body.en .category li a')[0]){
//     $('body.en .category li a').each(function(){
//       $(this).text(change_english($(this).text()));
//     });
//   }
//
//   // post一覧
//   if($('body.en .post li .post_tag')[0]){
//     $('body.en .post li .post_tag').each(function(){
//       $(this).text(change_english($(this).text()));
//     });
//   }
//
//   function change_english(txt){
//     switch (txt) {
//       case '北海道':
//       return 'Hokkaido';
//       break;
//
//       case '東北':
//       return 'Tohoku';
//       break;
//
//       case '関東':
//       return 'Kanto';
//       break;
//
//       case '中部':
//       return 'Chubu';
//       break;
//
//       case '近畿':
//       return 'Kinki';
//       break;
//
//       case '中国':
//       return 'Chugoku';
//       break;
//
//       case '四国':
//       return 'Shikoku';
//       break;
//
//       case '九州・沖縄':
//       return 'Kyushu-Okinawa';
//       break;
//
//       case 'ヨーロッパ':
//       return 'Europe';
//       break;
//
//       case '北アメリカ':
//       return 'North america';
//       break;
//
//       case '中央アメリカ':
//       return 'Central America';
//       break;
//
//       case '南アメリカ':
//       return 'South America';
//       break;
//
//       case 'アジア':
//       return 'Asia';
//       break;
//
//       case 'オセアニア':
//       return 'Oceania';
//       break;
//
//       case 'アフリカ':
//       return 'Africa';
//       break;
//
//       case '南極大陸':
//       return 'Antarctica';
//       break;
//
//       case 'その他':
//       return 'Others';
//       break;
//     }
//   }
// },150);
// }
