<!doctype html>
<html lang="ru">
    <?php echo head("Отделы"); ?>
    <body>
        <?php
            echo section(
                menu().
                content(
                    form(
                        "Введите название", "name"
                    )
                )
            );
            echo section(
                content(
                    h1("Департаменты").
                    departments_list($db)
                )
            );
        ?>
    </body>
</html>
