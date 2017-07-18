<!DOCTYPE html>
<html lang="en">
<?php echo head("Список отзывов");?>
<body>
<?php
    echo div_class("jumbotron text-center", "
        <h1>Список отзывов</h1>
        <p>Добавить отзыв можно <a href=\"/add_post\">здесь</a>.</p> 
    ");
    echo container(
        row(
            col("sm-12",
                div_class("jumbotron",
                    p("Выберите сортировку").
                    href_button("/posts", "По дате").
                    href_button("/posts/?rds=ok","По дате в обратном порядке").
                    href_button("/posts/?ls=ok","По лайкам").
                    href_button("/posts/?rls=ok","По лайкам в обратном порядке")
                ).
                posts_list($db)
            )
        )
    );
?>
</body>
</html>
