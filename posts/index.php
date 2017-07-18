<?php
    const SERV_DIR = "/home/al/server/mysite.zz";
    const INDEX    = "";
    include (SERV_DIR."/cfg/err_print.php");
    include (SERV_DIR."/cfg/core.php");
    include (SERV_DIR."/cfg/html_maker.php");

    session_start();

    $db = new MyDB();
    $db->connect();

    if (isset($_GET["id"])) {
        $db->add_like_to_post($_GET["id"]);
    }

    include (SERV_DIR."/posts/template.php");
    $db->close();
?>

