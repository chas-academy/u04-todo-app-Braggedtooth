<?php 
 include_once 'include\todo.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>

<body>
  <section class="container box is-flex-direction-row ">
    <div class=" row is-half " >

      <h1 class="title has-text-centered has-text-black has-background-info">
       TODOLIST
      </h1>


      <form method="POST">
        <div class="field">
          <label for="addtodo" class="label">New Todo</label>
          <input class="input is-danger" id="addtodo" type="text" placeholder="Add Todo" name="todoItem">
        </div>
       
        <div class="field has-text-centered">
          <input name="submit" type="submit" class="button is-success m-50">
        </div>

      </form>
    </div>

    <form class="row is-half" method="POST">
      <h1 class="title"> Edit </h1>
     <input type="hidden" id="id" name="id" value="<?php echo$id?>">
      <div class="field">
          <label for="addtodo" class="label">Edit Todo</label>
          <input class="input is-danger is-required" id="todo_item" type="text" placeholder="Add Todo" value="<?php echo $title;?>" name="todo_item">
        </div>
        
        <div class="field has-text-centered">
          <button name="update" type="submit" class="button is-warning left">Update</button>
        </div>

    </form>

   



</section>

<table class="container table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"> Item </th>
          <th scope="col">Date</th>
          <th scope="col" colspan="3"> Actions </th>
        </tr>
        <thead>

          <?php 
    function pre_r($array){
      echo '<pre>';
      print_r($array);
      echo '<pre>';
    }
    $display_data = $mysqli-> query("SELECT * FROM `user`") or die($mysqli->error);

    //pre_r($display_data->fetch_assoc());
//gör  en if vilkor som visar en FORM där användare kan ändra TODO
    ?>
          <?php while ($row = $display_data->fetch_assoc()): ?>
          <?php $item_id = '#'. strval($row['id']);
                 $item_target = strval($row['id']); 
          ?>

            <tr>
            <td scope="row"> <?php echo $row['id'] ?> </td>
            <td> <?php echo $row['todo_item'] ?> </td>
          
            <td> <?php echo $row['date'] ?> </td>
            <td>
              <a href="index.php?edit=<?php echo $row['id'];?>" class="button is-info">EDIT</a>
            </td>
            <td>
              <a href="index.php?delete=<?php echo $row['id'];?>" class="button is-danger">DELETE</a>
            </td>
            <td>
            <a href="index.php?complete=<?php echo $row['id'];?> "  class="button is-success">Complete</a> 
            </td>

          </tr>
          <?php endwhile;?>
    </table>





  
  <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
  </script>
</body>

</html>