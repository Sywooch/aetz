$(document).ready(function(){
    $('.search').click(function(e) {
    var $message = $('.s_input');
    if ($message.css('display') != 'block') {
        $message.show();
 
        var firstClick = true;
        $(document).bind('click.myEvent', function(e) {
            if (!firstClick && $(e.target).closest('.s_input').length == 0) {
                $message.hide();
                $(document).unbind('click.myEvent');
            }
            firstClick = false;
        });
    }
    e.preventDefault();
    });
});    