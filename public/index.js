
$(document).ready(function(){


    $('.btn-minuse').on('click', function(){            $(this).parent().siblings('input').val(parseInt($(this).parent().siblings('input').val()) - 1)
    })

    $('.btn-pluss').on('click', function(){            $(this).parent().siblings('input').val(parseInt($(this).parent().siblings('input').val()) + 1)
    })


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
    $('.f-modal-alert').fadeIn();

});