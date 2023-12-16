<?php
include_once 'include\todo.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="style\style.css">
</head>
<!-- ?php if(isset($_SESSION['message'])){
  echo"<div class= \"notification ". $_SESSION['msg_type']." box>" ."<button class=\"delete" ." onclick=\"remButton()>"."</button>". "<h2>" .$_SESSION['message']."</div>";
} else {
  echo "<div class='hidden'> <div>";
};
  ?>  -->

<body>
    <!-- Notification for SESSION variable -->
    <?php
     
if (isset($_SESSION['message'])):?>
    <div class="notification has-text-dark  has-text-center <?php echo $_SESSION['msg_type']?> box">
        <button class="delete" onclick="remButton()"></button>
        <?php echo $_SESSION['message'];?>
    </div>


    <?php endif ?>

    <!--heading -->
    <h1 class="title has-text-centered has-text-black has-background-info">
        TODOLIST
    </h1>
    <section class="section columns">

        <section class="container box is-flex-direction-row column is-two-fifths">
            <div class=" row is-half ">



                <!-- Input for Adding New Task -->
                <form method="POST">
                    <h1 class="title has-text-centered has-text-success-light has-background-link-dark"> Add Task </h1>
                    <div class="field">
                        <label for="addtodo" class="label">New Task</label>
                        <input class="input is-primary" id="addtodo" type="text" placeholder="Task Name"
                            name="todo_item" autofocus required>
                    </div>
                    <div class="field">
                        <label for="addtododesc" class="label">Description</label>
                        <input class="textarea has-fixed-size" id="todo_desc" type="text" placeholder="Todo Description"
                            name="todo_desc">
                    </div>

                    <div class="field has-text-centered">
                        <input name="submit" type="submit" class="button is-success m-50">
                    </div>

                </form>
            </div>
            <!-- Input for Edit Task-->
            <form class="row is-half" method="POST">
                <h1 class="title has-text-centered has-text-warning has-background-info-dark mt-5"> Edit Task </h1>
                <input type="hidden" id="id" name="id" value="<?php echo$id?>">
                <div class="field">
                    <label for="addtodo" class="label"> Task Name</label>
                    <input class="input is-warning " id="todo_item" type="text" placeholder="Edit Todo"
                        value="<?php echo $title;?> " name="todo_item" required>
                </div>
                <div class="field">
                    <label for="todoDesc" class="label">Description</label>
                    <input class="textarea has-fixed-size is-primary" id="todoDesc" type="text"
                        placeholder="Change Description" value="<?php echo $description;?>" name="todoDesc">
                </div>

                <div class="field has-text-centered">
                    <button name="update" type="submit" class="button is-warning left "
                        <?php echo $updatebtn; ?>>Update</button>
                </div>

            </form>





        </section>


        <table class="box table is-bordered is-striped is-narrow is-fullwidth column is-9 is-offset-1">
            <!--      <?php
        echo "<a href=\"index.php?completeall\" class=\"button is-success\">Complete All </a>" ;?> -->

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"> Item </th>
                    <th scope="col"> Description </th>
                    <th scope="col">Date</th>
                    <th scope="col" colspan="3"> Actions </th>
                </tr>
                <thead>

                    <?php
    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '<pre>';
    }
    $display_data = $mysqli-> query("SELECT * FROM `todos`") or die($mysqli->error);

    //pre_r($display_data->fetch_assoc());
//gör  en if vilkor som visar en FORM där användare kan ändra TODO
    ?> <?php while ($row = $display_data->fetch_assoc()): ?> <tr>
                        <td scope="row"> <?php echo $row['id'] ?> </td>
                        <td> <?php echo $row['todo_item'] ?> </td>
                        <td>
                            <?php echo $row['todo_desc'] ?>
                        </td>

                        <td> <?php echo $row['date'] ?> </td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'];?>" class="button is-info">EDIT</a>
                        </td>
                        <td>
                            <a href="index.php?delete=<?php echo $row['id'];?>" class="button is-danger">DELETE</a>
                        </td>
                        <td>
                            <?php if ($row['complete']== "1") {
        echo "<a href=\"index.php?complete=".$row['id']."\" class=\"button is-success\">Task Completed</a>" ;
    } else {
        echo "<a href=\"index.php?complete=".$row['id']."\" class=\"button is-warning\">Complete Task</a>" ;
    } ?>

                        </td>

                    </tr>
                    <?php endwhile ?>
        </table>




    </section>

    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script>
    const rembtn = document.querySelector('.notification');

    function remButton() {
        rembtn.remove();
    }
    </script>
</body>

</html>