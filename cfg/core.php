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
        $this->query("
        SET NAMES 'utf8';
        SET CHARACTER SET utf8;
        ");
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

    
    // проверка того, ставили ли лайк с этого ip.
    function like_exist($id){
        $ip = get_ip();
        $check_query = $this->query("
                SELECT * FROM likes
                WHERE id = '$id' AND ip = '$ip' 
            ");
        return mysqli_fetch_array($check_query);
    }

    function select_post($id) {
        return $this->query("
            SELECT * FROM `posts`
            WHERE id = '$id'
        ");
    }

    function add_like_to_post($id) {
        $ip = get_ip();
        
        if (! $this->like_exist($id)){
            // запомнить, что лайк добавлен
            $this->query("
                INSERT INTO likes (`id`,`ip`)
                VALUES ('$id', '$ip')
            ");
            // увеличить колво лайков поста на один
            $this->query("
                UPDATE posts
                SET number_of_likes = number_of_likes + 1
                WHERE id = '$id'
            ");
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
                VALUES ('$date', '$name', '$text', '0', '$ip')
            ");
        }
    }
}


function ip_to_name ($ip) {
    return "ip".str_replace(".", "_", $ip);
}

function get_ip(){
    return ip_to_name($_SERVER['REMOTE_ADDR']);
}

function post_date_sort($arr) {
    return uasort($arr, 'cmp_dates');
}

function post_date_rsort($arr) {
    return uasort($arr, 'cmp_rdates');
}

function post_like_sort($arr) {
    return uasort($arr, 'cmp_likes');
}

function post_like_rsort($arr) {
    return uasort($arr, 'cmp_rlikes');
}


//сравниваем по датам.
function cmp_dates($a, $b){
    if ($a['date'] > $b['date']) {
        return 1;
    } elseif ($a['date'] === $b['date']) {
        return 0;
    } else {
        return -1;
    }
}

function cmp_rdates($a, $b) {
    return cmp_dates($b, $a);
}

// сравниваем по лайкам
function cmp_likes($a, $b){
    if ($a['number_of_likes'] > $b['number_of_likes']){
        return 1;
    } elseif ($a['number_of_likes'] === $b['number_of_likes']){
        return 0;
    } else {
        return -1;
    }
}

function cmp_rlikes ($a, $b) {
    return  cmp_likes($b, $a);
}

//перекинуть в массив
function to_arr($res) {
    $arr = [];
    while ($row = mysqli_fetch_array($res)) {
        $arr[] = $row;  
    }
    return $arr;
}

?>
