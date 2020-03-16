$(function(){
    'user strict';
    function toggleChangeBtn() {
        var slideIndex = $('.slide').index($('.active'));/*activeクラスがついている要素(現在表示中のスライド)のindexを取得*/
        $('.slide-btn').show();/*両ボタンを表示*/
        if(slideIndex == 0){/*一番最初の要素が表示されているとき*/
            $('.prev').hide();/*prevボタンを隠す。*/
        }else if(slideIndex == $('.slide').length - 1){/*一番最後の要素が表示されているとき*/
            $('.next').hide();/*nextボタンを隠す。*/
        }
    }

    toggleChangeBtn();

    $('.next').click(function() {/*nextボタンを押したとき*/
        var $displaySlide = $('.active');/*現在表示中のスライドを取得*/
        $displaySlide.removeClass('active');/*そのスライドからactiveクラスを除いて表示されないようにする。*/
        $displaySlide.next().addClass('active');/*次のスライドにactiveクラスをつけ、表示させる。*/
        toggleChangeBtn();/*nextボタンを隠すか判断*/
    });
    $('.prev').click(function() {/*prevボタンを押したとき*/
       var $displaySlide = $('.active');/*現在表示中のスライドを取得*/
       $displaySlide.removeClass('active');/*そのスライドからactiveクラスを除いて表示されないようにする。*/
       $displaySlide.prev().addClass('active');/*前のスライドにactiveクラスをつけ、表示させる。*/
       toggleChangeBtn();/*prevボタンを隠すか判断*/
    });
    
    $('.close, .modal-overlay').click(function() {/*closeボタンを押したとき*/
       $('.active').removeClass('active');/*activeクラスを除いて表示されないようにする。*/
    });

    $('#logout-link').click(function(e) {
        e.preventDefault();
        $('#logout-form').submit();
    });

});
