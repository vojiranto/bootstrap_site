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
            "root",
            "090494a",
            "my_site"
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
    
    //------------------------------------------------------------------------
    // запросить все департаменты.
    function departments () {
        return $this->query("SELECT * FROM `Department`");
    }
    
    function add_department($name) {
        $this->query("
            INSERT INTO `Department` (`name`)
            VALUES ('$name')
        ");
    }
    
    function del_department($id) {
        $this->query("
            DELETE FROM `Department`
            WHERE `id` = '$id'
        ");
    } 
    
    //запросить всех кандидатов.
    function employees() {
        return $this->query("SELECT * FROM `Employee`");
    }

    //добавить претендента
    function add_employee($firstName, $lastName, $dep_id) {
        $this->query("
            INSERT INTO `Employee` (`firstName`, `lastName`, `departmentId`)
            VALUES ('$firstName', '$lastName', '$dep_id')
        ");
    }
    
    function del_employee($id) {
        $this->query("
            DELETE FROM `Employee`
            WHERE `id` = '$id'
        ");
    }
}
?>
