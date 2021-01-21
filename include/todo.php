<?php 
require_once 'db_connect.php';
session_start();

$title ="";
$description =" ";
db();
global $mysqli;
    if(isset($_POST['submit'])){
        $title = $_POST['todoItem'];
        $description = $_POST['todoDescription'];
        
        $mysqli->query("INSERT INTO `user`( `todo_item`, `todo_desc`, `date`)VALUES ('$title', '$description',CURRENT_TIME())")or die($mysqli->error) ;
        $_SESSION['message'] ="Todo Added!";
        $_SESSION['msg_type'] ="is-success";

    };

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM `user` WHERE id = $id") or die($mysqli->error) ;
        $_SESSION['message'] ="Todo Deleted!";
        $_SESSION['msg_type'] ="danger";
    }
    if( isset($_GET['edit'])){
        $id = $_GET['edit'];
        $check = $mysqli->query("SELECT * FROM `user` WHERE id = $id") or die($mysqli->error);
            $row = $check->fetch_array();
            $title = $row['todo_item'];
            $description = $row['todo_desc'];
       
            //Hämta datan med id och lägg i en ny formulär så att användaren kan se och sedan kunna ändra. 
       
    }

    if(isset($_POST['update'])){
        $id= $_POST['id'];
        $title =$_POST['todo_item'];
        $description =$_POST['todo_desc'];
        var_dump($id);
        $mysqli->query("UPDATE `user` SET `todo_item` = '$title' , `todo_desc` ='$description' WHERE id=$id ") or die($mysqli->error);
        $_SESSION['message'] ="Todo Updated!";
        $_SESSION['msg_type'] ="is-warning";
    }

 ?>