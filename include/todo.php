<?php 
require_once 'db_connect.php';
session_start();

$title ="";
$description =" ";
//connect to database
db();
global $mysqli;



    
   
        if(isset($_POST['submit'])){
            $title = $_POST['todoItem'];
            $description = $_POST['todoDescription'];
           
            if ($title !=""){
                $mysqli->query("INSERT INTO `user`( `todo_item`,`todo_desc`, `date`)VALUES ('$title','$description', CURRENT_TIME())")or die($mysqli->error) ;
                $_SESSION['message'] = "Todo Added Successfully";
                $_SESSION['msg_type'] ="is-success";
            }else {
                $_SESSION['message'] = "Input Invalid ";
                header("location:index.php");
            }
    
        };
    


    

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM `user` WHERE id = $id") or die($mysqli->error) ;
        $_SESSION['message'] ="Todo Deleted!";
        $_SESSION['msg_type'] ="is-danger";
        
    }
    if( isset($_GET['edit'])){
        $id = $_GET['edit'];
        $check = $mysqli->query("SELECT* FROM `user` WHERE id = $id") or die($mysqli->error);
            $row = $check->fetch_array();
            $title = $row['todo_item'];
            $description = $row['todo_desc'];
            
       
            //Hämtar datan med id och lägg i en ny formulär så att användaren kan se och sedan kunna ändra. 
       
    }

    if (isset($_POST['update'])) {
        $id= $_POST['id'];
        $title =$_POST['todo_item'];
        $description = $_POST['todo_desc'];
        if ($title !="") {
            $mysqli->query("UPDATE `user` SET `todo_item` = '$title' , `todo_desc`='$description'  WHERE id=$id ") or die($mysqli->error);
            $_SESSION['message'] ="Todo Updated!";
            $_SESSION['msg_type'] ="is-warning";
        }else {
            $_SESSION['message'] ="Press EDIT on the item you want to update";
            $_SESSION['msg_type'] ="is-warning";
        }
    }
    //check if task is done
    $done= 0 ;
    
    if(isset($_GET['complete'])){
        global $done;
        global $id;
        $id = $_GET['complete']; 
        $complete = $mysqli->query("SELECT `complete` FROM `user` WHERE id = $id") or die($mysqli->error);
        $row = $complete->fetch_assoc();
        $done = (int)$row['complete'] ;
          if ($done == 0){
              $done = 1;
              
            } else { 
            $done = 0;
           

            
        };  
       /*  if ($task_complete == false|| $done== 0){
            $complete_class = 'is-warning';
            $complete_btn = 'Complete Task';
          
        } else{
            $complete_class = 'is-success';
            $complete_btn = 'Task Complete';
        };  */ 

            $mysqli -> query("UPDATE `user` SET `complete`= '$done' WHERE id=$id ") or die($mysqli->error);
        }; 
        
//complete class and text changes 



      
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
 ?>