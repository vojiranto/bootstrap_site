<?php

defined('INDEX') OR die('Прямой доступ к странице запрещён!');
define("SITE_HOST", "mysite.zz");

// MYSQL
class MyDB {
    var $link;

    var $err;
    var $fetch;

    // упрощаем форму запроса к базе.
    function query($query){
        return mysqli_query($this->link, $query);
    }

    // Соединение с базой данных.
    function connect() {

        // получение ссылки.
        $this->link = mysqli_connect(
            "localhost",
            "al",
            "aL_pass0",
            "b_site"
        );

        // установка кодировки.
        $this->query('SET NAMES utf8');
    }

    // Закрыть доступ к базе данных
    function close() {
        mysqli_close($this->link);
    }
 
    function fetch() {
        while ($this->data = mysql_fetch_assoc($this->result)) {
            $this->fetch = $this->data;
            return $this->fetch;
        }
    }

    // остановка
    function stop() {
        unset($this->fetch);
        unset($this->err);
    }
    // извлекаем все посты из базы.
    function posts () {
        return $this->query("SELECT * FROM `posts`");
    }

    // вставка отзыва в базу данных. 
    // TODO Добавить проверку на HTML
    function add_post($date, $name, $text, $ip) {
    $this->query("
        INSERT INTO `posts` (`date`, `name`, `text`, `number_of_likes`, `IP`)
        VALUES ($date, $name, $text, 0, $ip);
    ");
}
}

?>
