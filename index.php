<?php
    const SERV_DIR = "/home/al/server/mysite.zz";
    const INDEX    = "";
    include (SERV_DIR."/cfg/err_print.php");
    include (SERV_DIR."/cfg/core.php");
    include (SERV_DIR."/cfg/html_maker.php");
?>

<!doctype html>
<html lang="ru">
    <?php echo head("Главная");?>
    <body>
        <?php echo section(menu()); ?>
    </body>
</html>
