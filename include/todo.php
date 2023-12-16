<?php
require_once 'db_connect.php';
session_start();

$mysqli = db();
$title = "";
$description = "";
$id = null;
$updatebtn = "disabled";

function redirect_with_message($location, $message, $msg_type)
{
    $_SESSION['message'] = $message;
    $_SESSION['msg_type'] = $msg_type;
    header("location: $location");
    exit;
}

function validate_id($id)
{
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        redirect_with_message("index.php", "Invalid ID", "is-danger");
    }
    return $id;
}

if (isset($_POST['submit'])) {
    $title = trim($_POST['todo_item']);
    $description = trim($_POST['todo_desc']);

    if (empty($description)) {
        $_SESSION['message'] = "Describe Task !";
        $_SESSION['msg_type'] = "is-danger";
    } else {
        try {
            $stmt = $mysqli->prepare("INSERT INTO `todos`( `todo_item`,`todo_desc`, `date`) VALUES (?, ?, CURRENT_TIME())");
            $stmt->execute([$title, $description]);
            $_SESSION['message'] = "Task Added ";
            $_SESSION['msg_type'] = "is-success";
            $title = "";
            $description = "";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
            $_SESSION['msg_type'] = "is-danger";
            $description = " ";
            $title = "";
        }
    }
};

//DELETE FUNCTION
if (isset($_GET['delete'])) {
    $id = validate_id($_GET['delete']);
    try {
        $stmt = $mysqli->prepare("DELETE FROM `todos` WHERE id = ?");
        $stmt->execute([$id]);
        redirect_with_message("index.php", "Task Deleted!", "is-danger");
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['msg_type'] = "is-danger";
        $description = " ";
        $title = "";
    }
}

// EDIT FUNCTION
if (isset($_GET['edit'])) {
    $id = validate_id($_GET['edit']);
    try {
        $stmt = $mysqli->prepare("SELECT* FROM `todos` WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = $row['todo_item'];
        $description = $row['todo_desc'];
        $updatebtn = " ";

        $_SESSION['message'] = "Edit Task!";
        $_SESSION['msg_type'] = "is-link";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['msg_type'] = "is-danger";
        $description = " ";
        $title = "";
    }
}

//UPDATE FUNCTION
if (isset($_POST['update'])) {
    $id = validate_id($_POST['id']);
    $title = $_POST['todo_item'];
    $description = $_POST['todoDesc'];
    try {
        $stmt = $mysqli->prepare("UPDATE `todos` SET `todo_item` = ? , `todo_desc`= ? WHERE id= ?");
        $stmt->execute([$title, $description, $id]);
        redirect_with_message("index.php", "Task Updated!", "is-warning");
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['msg_type'] = "is-danger";
        $description = " ";
        $title = "";
    }
}

if (isset($_GET['complete'])) {
    $id = validate_id($_GET['complete']);
    try {
        $stmt = $mysqli->prepare("SELECT `complete` FROM `todos` WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $done = (int)$row['complete'];
        $_SESSION['clickedRow'] = $id;
        if ($done == 0) {
            $stmt = $mysqli->prepare("UPDATE `todos` SET `complete`= '1' WHERE id= ?");
            $stmt->execute([$id]);
            redirect_with_message("index.php", "Task Completed!", "is-success");
        } else {
            $stmt = $mysqli->prepare("UPDATE `todos` SET `complete`= '0' WHERE id= ?");
            $stmt->execute([$id]);
            redirect_with_message("index.php", "Task Incomplete!", "is-info");
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['msg_type'] = "is-danger";
        $description = " ";
        $title = "";
    }
};

session_destroy();
