
$(document).ready(function(){

    /* Table validation */

    $('.sandwich').children().hide();

    $('.sandwich').hover(function(){
        $(this).children().fadeIn();
    }, function(){
        $(this).children().fadeOut();
    });

    $('.min > .fas').click(function(){

        if($('#tabvalidation tr:visible').length > 1){
            $(this).parents('tr').fadeOut();
        } else {
            window.location.href='/';
        }
    });

    /*Payment*/

    $('.f-modal-alert').hide();
    $('img.img-center.gif').hide();

    $('.f-modal-alert').fadeIn();

    $('img.img-center.gif').fadeIn(2000);

});