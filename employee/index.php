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
    if (isset($_GET["id"])   and
        isset($_GET["name"]) and
        isset($_GET["dep_id"])) {

        $db->add_employee(
            $_GET["id"],
            $_GET["name"],
            $_GET["dep_id"]
        );
    }
    
    // удаление из базы данных
    if (isset($_GET["del"])) {
        $db->del_employee($_GET["del"]);
    }
    
    include (SERV_DIR."/employee/template.php");
    $db->close();
?>
