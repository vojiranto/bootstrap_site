<?php
    const INDEX    = "";
    include ("./../cfg/err_print.php");
    include ("./../cfg/core.php");
    include ("./../cfg/html_maker.php");

    session_start();

    $db = new MyDB();
    $db->connect();

    if (isset($_GET["id"])) {
        $db->add_like_to_post($_GET["id"]);
    }

    include ("./../posts/template.php");
    $db->close();
?>

