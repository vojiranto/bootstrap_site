<!doctype html>
<html lang="ru">
    <?php echo head("Посты"); ?>
    <body>
        <?php
            echo section(
                menu().
                content(
                    form(
                        "Имя", "name",
                        "Текст", "text"
                    )
                )
            );
            echo section(
                content(
                    h1("Посты").
                    posts_list($db)
                )
            );
        ?>
    </body>
</html>
