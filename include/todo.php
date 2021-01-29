<?php
require_once 'db_connect.php';
session_start();

$title ="";
$description =" ";
//connect to database
db();
global $mysqli;
$updatebtn = "disabled";


    
   
        if (isset($_POST['submit'])) {
            $title = $_POST['todo_item'];
            $description = $_POST['todo_desc'];
           
            if (empty($description)) {
                $_SESSION['message'] = "Describe Task !";
                $_SESSION['msg_type'] ="is-danger";
            } else {
                $mysqli->query("INSERT INTO `todos`( `todo_item`,`todo_desc`, `date`)VALUES ('$title','$description', CURRENT_TIME())")or die($mysqli->error) ;
                $_SESSION['message'] = "Task Added ";
                $_SESSION['msg_type'] ="is-success";
            }
        };
    


    
//DELETE FUNCTION
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM `todos` WHERE id = $id") or die($mysqli->error) ;
        $_SESSION['message'] ="Task Deleted!";
        $_SESSION['msg_type'] ="is-danger";
        header("location: index.php");
        exit;
    }

    // EDIT FUNCTION
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $check = $mysqli->query("SELECT* FROM `todos` WHERE id = $id") or die($mysqli->error);
        $row = $check->fetch_array();
        $title = $row['todo_item'];
        $description = $row['todo_desc'];
        $updatebtn = " ";

        $_SESSION['message'] ="Edit Task!";
        $_SESSION['msg_type'] ="is-link";
        

     
       
        //Hämtar datan med id och lägg i en ny formulär så att användaren kan se och sedan kunna ändra.
    }
//UPDATE FUNCTION
       if (isset($_POST['update'])) {
           $id= $_POST['id'];
           $title =$_POST['todo_item'];
           $description = $_POST['todoDesc'];
           $mysqli->query("UPDATE `todos` SET `todo_item` = '$title' , `todo_desc`='$description'  WHERE id=$id ") or die($mysqli->error);
           $_SESSION['message'] ="Task Updated!";
           $_SESSION['msg_type'] ="is-warning";
           header("location: index.php");
           exit;
       }

    //check if task is done
    $done= 0 ;
    
    if (isset($_GET['complete'])) {
        global $done;
        global $id;
        $id = $_GET['complete'];
        $complete = $mysqli->query("SELECT `complete` FROM `todos` WHERE id = $id") or die($mysqli->error);
        $row = $complete->fetch_assoc();
        $done = (int)$row['complete'] ;
        if ($done == 0) {
            $done = 1;
            $_SESSION['message'] ="Task Completed!";
            $_SESSION['msg_type'] ="is-success";
            header("location: index.php");
        } else {
            $done = 0;
            $_SESSION['message'] ="Task Incomplete!";
            $_SESSION['msg_type'] ="is-info";
            header("location: index.php");
        }
        if ($done==1) {
            $mysqli->query("DELETE FROM `todos` WHERE date() < (CURDATE()- INTERVAL  2 DAY)");
        };
        /*  if ($task_complete == false|| $done== 0){
             $complete_class = 'is-warning';
             $complete_btn = 'Complete Task';

         } else{
             $complete_class = 'is-success';
             $complete_btn = 'Task Complete';
         };  */

        $mysqli -> query("UPDATE `todos` SET `complete`= '$done' WHERE id=$id ") or die($mysqli->error);
        exit;
    };
        
    
//COMPLETE ALL TASK!
/* if (isset($_GET['completall'])) {
    $mysqli->query("SELECT `complete` FROM `todos` WHERE `complete` = 0") or die($mysqli->error);

    $mysqli->query("UPDATE `todos` SET `complete` = 1 ,   WHERE `complete` = 0") or die($mysqli->error);
} */


      
        /*     if (isset($_GET['complete'])==$id||$done==1){
                $complete_class = 'is-success';
                $complete_btn = 'Task Complete';


            }else {
                 $complete_class = 'is-warning';
                 $complete_btn = 'Complete Task';
            }; */
            
          /*   global $done;
            global $id;
            if($done == 0){
                echo `<a href="index.php?complete=<?php echo $id;?>" class="button is-warning">Complete Task</a>`;
}else{ echo `<a href="index.php?complete=<?php echo $id;?>" class="button is-success">Task Completed </a>`;}; */






//fecth_array returnerar en string därav inability att ändrar complete status med funtionen ovan.





session_destroy();