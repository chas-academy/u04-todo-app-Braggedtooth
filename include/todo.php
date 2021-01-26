<?php 
require_once 'db_connect.php';
session_start();

$title ="";
$description =" ";
db();
global $mysqli;
    if(isset($_POST['submit'])){
        $title = $_POST['todoItem'];
        $mysqli->query("INSERT INTO `user`( `todo_item`, `date`)VALUES ('$title', CURRENT_TIME())")or die($mysqli->error) ;
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
            
       
            //Hämta datan med id och lägg i en ny formulär så att användaren kan se och sedan kunna ändra. 
       
    }

    if(isset($_POST['update'])){
        $id= $_POST['id'];
        $title =$_POST['todo_item'];
        $mysqli->query("UPDATE `user` SET `todo_item` = '$title'  WHERE id=$id ") or die($mysqli->error);
        $_SESSION['message'] ="Todo Updated!";
        $_SESSION['msg_type'] ="is-warning";
    }
    //check if task is done
   
    if(isset($_GET['complete'])){
        $id = $_GET['complete']; 
        $complete = $mysqli->query("SELECT `complete` FROM `user` WHERE id = $id") or die($mysqli->error);
        $row = $complete->fetch_assoc();
        $done = (int)$row['complete'] ;
         if ($done === 0){
            $done = 1;
        } else { 
            $done = 0;
        };  
        
       
          var_dump($done);
            $mysqli -> query("UPDATE `user` SET `complete`= '$done' WHERE id=$id ") or die($mysqli->error);
        };

      
    //fecth_array returnerar en string därav inability att ändrar complete status med funtionen ovan.
        
       
       

    

 ?>