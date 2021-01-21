<?php
function db(){
    global $mysqli;
    $mysqli = new mysqli('localhost', 'root' ,'root', 'todolist') or die(mysqli_error($mysqli));
    return $mysqli;
}
if (db()){
    echo  "Server Connected";
} else echo "Server Offine";
