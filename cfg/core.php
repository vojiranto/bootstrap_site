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

    function add_user() {
        $ip   = $_SERVER['REMOTE_ADDR'];
        $this->query("CREATE TABLE $ip (id int)");
    }
    
    // возвращает true, если таблица существует
    function user_exist(){
        $ip = $_SERVER['REMOTE_ADDR'];
        return "" !== $this->query(
            "SHOW TABLES LIKE \"$ip\""
        );
    }
    
    // проверка того, ставили ли лайк с этого ip.
    function like_exist($id){
        $ip = $_SERVER['REMOTE_ADDR'];
        return (bool)mysql_num_rows(
            $this->query("
                SELECT 1 FROM `$ip`
                WHERE `id` = $id
                LIMIT 1 
            ")
        );
    }

    function add_like_to_post($id) {
        $ip    = $_SERVER['REMOTE_ADDR'];
        
        if (!$this->user_exist()){
            $this->add_user();
        }
        
        if (!$this->like_exist()){
            // запомнить, что лайк добавлен
            $this->query("
                INSERT INTO `$ip` (`id`)
                VALUES ('$id')
            ");
            // увеличить колво лайков поста на один
            $this->query("
                UPDATE posts
                SET number_of_likes = number_of_likes + 1
                WHERE id = '$id'
            ")
        }
    }

    function add_post($name, $text) {
        $date = date('Y-m-d H:i:s');
        $ip   = $_SERVER['REMOTE_ADDR'];
        // проверка на наличие HTML разметки.
        if (strip_tags($text) === $text) {
            $text = nl2br($text);
            $this->query("
                INSERT INTO `posts` (`date`, `name`, `text`, `number_of_likes`, `IP`)
                VALUES ('$date', '$name', '$text', '0', '$ip');
            ");
        }
    }
}

?>
