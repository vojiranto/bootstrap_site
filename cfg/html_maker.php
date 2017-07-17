<?php
defined('INDEX') OR die('Прямой доступ к странице запрещён!');

//ссылка для удаления.
function del_linc($id){
    return "<a href='?del=$id'>удалить</a>";
}

// Напечатать список всех постов
function posts_list($db){
    // Выдёргиваем списоr постов.
    $res = $db->posts();
    $str = "";
    while ($row = mysqli_fetch_array($res)) {
        $row_name = $row['name'];
        $row_text = $row['text'];
        $str = "$str
            <br>$row_name: $row_text";
    }

    if ($str === "") {
        $str = "Здесь пока пусто, добавьте департамент в список";
    }
    return $str;
}

// Напечатать список всех департаментов
function departments_list($db){
    // Выдёргиваем списоr департаментов.
    $res = $db->departments();
    $str = "";
    while ($row = mysqli_fetch_array($res)) {
        $row_name = $row['name'];
        $str = $str."
            <br>$row_name ".del_linc($row['id']);
    }

    if ($str === "") {
        $str = "Здесь пока пусто, добавьте департамент в список";
    }

    return $str;
}

function employee_list($db){
    // Выдёргиваем списоr департаментов.
    $res = $db->employees();
    $str = "";
    while ($row = mysqli_fetch_array($res)) {
        $firstName  = $row['firstName'];
        $row_name   = $row['lastName'];
        $row_dep_id = $row['departmentId'];
        $str = "$str
            <br>$firstName $row_name, $row_dep_id ".del_linc($row['id']);
    }

    if ($str === "") {
        $str = "Здесь пока пусто, добавьте кандидата в список";
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

function head($title) {
    return "
    <head>
        <meta charset=\"utf-8\">
        <link rel=\"stylesheet\" href=\"/css/default.css\">
        <title>$title</title>
    </head>
";
}

//создаём боковое меню.
function menu () {
    return "
    <div class=\"menu\">
        <p>Меню</p>
        <a href=\"/employee\">Employee</a>
        <a href=\"/depatrment\">Depatrment</a>
    </div>";
}

function section ($cont) {
    return "
    <div class=\"section\">
        $cont
    </div>
    ";
}

function content ($cont) {
    return "
    <div class=\"content\">
        $cont
    </div>    
";
}

function h1 ($cont) {
    return "<h1>$cont</h1>";
}
?>
