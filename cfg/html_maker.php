<?php
defined('INDEX') OR die('Прямой доступ к странице запрещён!');

//ссылка для удаления.
function del_linc($id){
    return "<a href='?del=$id'>удалить</a>";
}

function button ($onclick, $txt) {
    return "
    <button type=\"button\" class=\"btn btn-default\" onclick=\"$onclick\">$txt</button>
";
}

function href_button($href, $txt) {
    return button("window.location.href='$href'", $txt);
}

function add_like_button ($id, $txt) {
    return href_button("/posts/?id=$id", $txt);
}

// Напечатать список всех постов

function print_post($post){
    $name = $post['name'];
    $text = $post['text'];
    $date = $post['date'];
    return "
    Автор отзыва: $name.<hr>
    $text<br><hr>
    $date
";
}

function posts_list($db){

    // Выдёргиваем списоr постов.
    $str = "";
    $posts = to_arr($db->posts());

    // настройка порядка вывода сообщений.
    if (isset($_GET["rds"])) {
        uasort($posts, 'cmp_rdates');
    } elseif (isset($_GET["ls"])) {
        uasort($posts, 'cmp_rlikes');
    } elseif (isset($_GET["rls"])) {
        uasort($posts, 'cmp_likes');
    }

    foreach ($posts as $post) {
        $id = $post['id'];
        $str  = $str.div_class("jumbotron",
            print_post($post)."<br>".
            add_like_button($id, $post['number_of_likes']." лайков").
                href_button("/post/?id=$id","Просмотреть это сообщение подробнее")
            );
    }

    if ($str === "") {
        $str = "Здесь пока пусто, добавьте департамент в список";
    }
    return $str;
}


//Создаём однотипные фрагменты html кода

// функция для создания формы
function input_placeholder($a, $b) {
    return "<input placeholder=\"$a\" name=\"$b\">";
}

function form () {
    $numargs = func_num_args();
    $args    = func_get_args();
    $comm    = "
    <!-- форма отправки get-запроса, автоматически созана функцией add_form -->
";
    $res = "";

    $res = "$res$comm<form>";
    for ($i = 0; $i < $numargs; $i+=2) {
        $res = "$res<p>".input_placeholder($args[$i], $args[$i+1]);
    }
    $res = "$res<p><input type=\"submit\" value=\"Добавить\">
        </form>$comm
";
    return $res;
}

/*
function head($title) {
    return "
    <head>
        <meta charset=\"utf-8\">
        <link rel=\"stylesheet\" href=\"/css/default.css\">
        <title>$title</title>
    </head>
";
}
*/

function textarea () {
    return div_class("form-group",
        "<textarea class=\"form-control\" rows=\"5\" id=\"comment\"></textarea>"
    );
}

function head($title) {
    $bootstrap = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7";
    $ajax      = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1";
    return "
<head>
    <title>Bootstrap Example</title>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <link rel=\"stylesheet\" href=\"$bootstrap/css/bootstrap.min.css\">
    <script src=\"$ajax/jquery.min.js\"></script>
    <script src=\"$bootstrap/js/bootstrap.min.js\"></script>
</head>
";}

//создаём боковое меню.
function menu () {
    return col("sm-4",
        p("Меню")."
        <a href=\"/employee\">Employee</a>
        <a href=\"/depatrment\">Depatrment</a>"
    );
}

function div_class($class, $cont){
    return "<div class=\"$class\">$cont</div>";
}

function container ($cont) {
    return div_class ("container", $cont);
}

function row ($cont) {
    return div_class("row", $cont);
}

function col ($sm, $cont){
    return div_class("col-$sm", $cont);
}

function section ($cont) {
    return div_class("section", $cont);
}

function content ($cont) {
    return div_class("content", $cont);
}

function h($i, $cont){
    return "<h$i>$cont</h$i>";
}

function h1 ($cont) {
    return h(1, $cont);
}

function h2 ($cont) {
    return h(2, $cont);
}

function h3 ($cont) {
    return h(3, $cont);
}

function h4 ($cont) {
    return h(4, $cont);
}

function h5 ($cont) {
    return h(5, $cont);
}

function h6 ($cont) {
    return h(6, $cont);
}

function p ($cont) {return tag ("p", $cont);}
function tag ($tag, $cont) {return "<$tag>$cont</$tag>";}

?>
