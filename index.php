<?php
include_once 'include\todo.php';

$display_data = $mysqli->query('SELECT * FROM `todos` ORDER BY `date` DESC') or die($mysqli->errorInfo());
$rows = $display_data->fetchAll(PDO::FETCH_ASSOC);
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

<body class="container is-widescreen mh">
    <!-- Notification for SESSION variable -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="notification has-text-dark is-small <?php echo $_SESSION['msg_type']; ?> ">
            <button class="delete" onclick="remButton()"></button>
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php endif ?>
    <!--heading -->
    <h1 class="title has-text-centered has-text-black">
        TODOLIST
    </h1>
    <section class="section">
        <section class="is-flex container is-align-content-space-between is-justify-content-space-between ">
            <!-- Include the form for adding new tasks -->
            <?php include 'templates/add_task_form.php'; ?>
            <!-- Include the form for editing tasks -->
            <?php include 'templates/edit_task_form.php'; ?>
        </section>
        <!-- Include the table for displaying tasks -->
        <section class="pt-0 table-container extTable  my-5 " id="scroll-container">
            <?php include 'templates/task_table.php'; ?>
        </section>
        <script src="script.js"></script>
</body>


</html>