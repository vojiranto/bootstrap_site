<?php
    const SERV_DIR = "/home/al/server/mysite.zz";
    const INDEX    = "";
    include (SERV_DIR."/cfg/err_print.php");
    include (SERV_DIR."/cfg/core.php");
    include (SERV_DIR."/cfg/html_maker.php");

    session_start();

    $db = new MyDB();
    $db->connect();

    // вставка в базу данных
    if (isset($_GET["name"])) {
        $db->add_department($_GET["name"]);
    }
    
    // удаление из базы данных
    if (isset($_GET["del"])) {
        $db->del_department($_GET["del"]);
    }
    
    include (SERV_DIR."/depatrment/template.php");
    $db->close();
?>

