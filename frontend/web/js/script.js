$(document).ready(function(){
 $('.search').on('click', function (e) {
        if($('.s_part').hasClass('s_active')){
            $('.s_part').removeClass('s_active');
        }
        else{
            $('.s_part').addClass('s_active');                  
        } 
         var $message = $('.s_part');
    if ($message.css('width') != '245px') {
            $message.css('width','245px');
            var firstClick = true;
        $(document).bind('click.myEvent', function(e) {
            if (!firstClick && $(e.target).closest('.s_part').length == 0) {
                $message.css('width','0px');
                $(document).unbind('click.myEvent');
            }
            firstClick = false;
        });
    }
    e.preventDefault();                          
    }); 
 $('.mob_start').on('click', function () {
        $('.m_menu').addClass('m_show');
        
         $('.m_show .submenu').on('click', function () {
        	 $('.m_show .submenu').removeClass('subshow');
        	 $(this).addClass('subshow');
       
}); 
  });
  $('.mob_close').on('click', function () {
        $('.m_menu').removeClass('m_show');
  });
       $('.single-item').slick({
            speed: 500,
            autoplay: true,
            autoplaySpeed: 2200,
            fade: true, 
            slidesToShow: 1,          
            cssEase: 'linear'
          });
           $('.second-item').slick({
            speed: 500,
            autoplay: true,
            autoplaySpeed: 1800,
            slidesToShow: 1,          
            cssEase: 'linear'
          });
            $('.carousel').slick({
             infinite: true,
             slidesToShow: 3,
             slidesToScroll: 3,
             autoplay: true,
                 responsive: [
            {
              breakpoint: 1240,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
              }
            },
            {
              breakpoint: 850,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 650,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 450,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }

          ]             
         
          }); 
             
});        