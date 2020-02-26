
function autoRefresh_chat()
{
    $("#infos_chat").load('refresh_chat.php');
}

setInterval('autoRefresh_chat()', 5000); // refresh tab after 5 secs


function autoRefresh_info()
{
    $("#infos_info").load('refresh_info.php');
}

setInterval('autoRefresh_info()', 5000); // refresh tab after 5 secs
