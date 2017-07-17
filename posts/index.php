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
    if (isset($_GET["name"]) and (isset($_GET["text"]))) {
        $db->add_post($_GET["name"], $_GET["text"]);
    }

    include (SERV_DIR."/posts/template.php");
    $db->close();
?>

