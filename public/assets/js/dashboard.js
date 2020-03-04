$(document).ready(function() {


    $('.addingred').click(function () {

        $('.ingredlist').append("<tr>\n" +
            "                            <td><input class='form-control form-control-sm id' type='text' value='#'/></td>\n" +
            "                            <td><input class='form-control form-control-sm nom' type='text' value='Nom'/></td>\n" +
            "                            <td><input class='form-control form-control-sm price' type='text' value='0'/></td>\n" +
            "                            <td><input class='form-control form-control-sm link' type='text' value=''/></td>\n" +
            "                            <td><input class='form-control form-control-sm dispo' type='text' value='1'/></td>\n" +
            "                            <td><a class=\"badge badge-success validingred\"><svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\" stroke=\"currentColor\" stroke-width=\"1.5\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"css-i6dzq1\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg></td>\n" +
            "                        </a></tr>");
    });

    $('.ingredlist').on("click", ".validingred", function () {

        console.log("add");

        var id=$('.form-control-sm.id').val();
        var nom=$('.form-control-sm.nom').val();
        var price=$('.form-control-sm.price').val();
        var link=$('.form-control-sm.link').val();
        var dispo=$('.form-control-sm.dispo').val();

        $(this).parents('tr').html("<td>"+ id +"</td>\n" +
            "                                    <td>"+ nom +"</td>\n" +
            "                                    <td>"+ price +"</td>\n" +
            "                                    <td><img src=\""+ link +"\" style=\"width: 24px;\"> "+ link +"</td>\n" +
            "                                    <td>"+ dispo +"</td>\n" +
            "                                    <td>\n" +
            "                                    <a class=\"badge badge-danger delingred\" id=\"1\">\n" +
            "                                    \n" +
            "                                    <svg viewBox=\"0 0 24 24\" width=\"16\" height=\"16\" stroke=\"currentColor\" stroke-width=\"1.5\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"css-i6dzq1\"><polyline points=\"3 6 5 6 21 6\"></polyline><path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path><line x1=\"10\" y1=\"11\" x2=\"10\" y2=\"17\"></line><line x1=\"14\" y1=\"11\" x2=\"14\" y2=\"17\"></line></svg>\n" +
            "                                 \n" +
            "                                 </a></td>");



        $(this).hide();

        console.log({type:'add', id:id, nom:nom, price:price, link:link, dispo:dispo});

        $.ajax({
            type: "POST",
            url: '/admin_ingredients.php',
            data: {type:'add', id:id, nom:nom, price:price, link:link, dispo:dispo},
            success : function () {
                setTimeout(function () {
                    //window.location = window.location.href;
                }, 300);
            }
        });

    });

    $('.delingred').click(function () {
        $(this).parents('tr').fadeOut();

        $.ajax({
            type: "POST",
            url: '/admin_ingredients.php',
            data: {type:'del', ingred_id:$(this).attr('id')}
        });
    });
    $('.delorders').click(function () {
        $(this).parents('tr').fadeOut();

        $.ajax({
            type: "POST",
            url: '/admin_orders.php',
            data: {type:'del', order_id:$(this).attr('id')}
        });
    });
    $('.delusers').click(function () {
        $(this).parents('tr').fadeOut();

        $.ajax({
            type: "POST",
            url: '/admin_users.php',
            data: {type:'del', user_id:$(this).attr('id')}
        });
    });
});