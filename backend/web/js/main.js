/**
 * Created by MyKos on 06.10.2014.
 */
$(document).ready(function() {

    $('.js-popup').on('click', function(){
        // listen click, open modal and .load content
        $($(this).data('target')).modal('show')
            .find('.modalContent')
            .load($(this).attr('data-url'));
        return false;
    });

    //$(".js-image-update").on('click', function(e){
    //    e.preventDefault();
    //
    //    $commentParams = $("#image-form").serialize();
    //
    //    $.ajax({
    //        type: "POST",
    //        url: 'update-image-title',
    //        data: $commentParams,
    //        success: function(result){
    //
    //            $('.ajax-model-images').html(data);
    //
    //            if(!result['error']){
    //                $("#comment-form").trigger('reset');
    //            }
    //        }
    //    });
    //});

});