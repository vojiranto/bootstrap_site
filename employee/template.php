<!doctype html>
<html lang="ru">
    <?php echo head("Кандидаты"); ?>
    <body>
        <?php
            echo section(
                menu().
                content(
                    form(
                        "Имя",              "id",
                        "Фамилия",          "name",
                        "Желаемый отдел",   "dep_id"
                    )
                )
            );
            echo section(
                content(
                    h1("Претенденты").
                    employee_list($db)
                )
            );
        ?>
    </body>
</html>
