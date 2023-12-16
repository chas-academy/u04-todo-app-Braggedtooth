<?php

$env = file_get_contents(__DIR__."/.env");
$lines = explode("\n",$env);
foreach($lines as $line){
  preg_match("/([^#]+)\=(.*)/",$line,$matches);
  if(isset($matches[2])){
    putenv(trim($line));
  }
} 

function db()
{
    $mysql_host = getenv('MYSQL_HOST');
    $mysql_database = getenv('MYSQL_DATABASE');
    $mysql_user = getenv('MYSQL_USER');
    $mysql_password = getenv('MYSQL_PASSWORD')??'';
    if (!$mysql_host || !$mysql_database || !$mysql_user ) {
        error_log("Missing environment variables for database connection");
        exit("Missing environment variables for database connection");
    }
    create_database_if_not_exists($mysql_host, $mysql_user, $mysql_password, $mysql_database);
    $dsn = "mysql:host=$mysql_host;dbname=$mysql_database;charset=utf8mb4";
    error_log( $mysql_host . $mysql_database . $mysql_user . $mysql_password);
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $mysql_user, $mysql_password, $options);

        // Check if table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'todos'");
        if ($stmt->rowCount() == 0) {
            create_table($pdo);
        }

        if ($_ENV['SEED_DB'] ?? false) {
            seed_db($pdo);
        }

        return $pdo;
    } catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage());
        exit("An error occurred while connecting to the database.");
    }
}

function create_table($pdo)
{
    // Create table if it doesn't exist
    $sql = "CREATE TABLE todos (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        todo_item VARCHAR(255) NOT NULL,
        todo_desc VARCHAR(255) NOT NULL,
        date DATE NOT NULL,
        complete BOOLEAN NOT NULL DEFAULT 0
    )";
    $pdo->exec($sql);
    error_log("Table created successfully");
}

function seed_db($pdo)
{
    // Seed table with data
    $sql = "INSERT INTO `todos` (`id`, `todo_item`, `todo_desc`, `date`, `complete`) VALUES
    (1, 'Task 1', 'Buy Matress', '2021-01-29', 1),
    (2, 'Task 2 ', 'Sell Matress', '2021-01-29', 0)";
    $pdo->exec($sql);
    error_log("Database seeded successfully");
}

function create_database_if_not_exists($mysql_host, $mysql_user, $mysql_password, $mysql_database)
{
    try {
        $pdo = new PDO("mysql:host=$mysql_host;charset=utf8mb4", $mysql_user, $mysql_password);

        // Create the database if it doesn't exist
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$mysql_database`")
            or die(print_r($pdo->errorInfo(), true));

    } catch (PDOException $e) {
        error_log("Could not connect to the database server: " . $e->getMessage());
        exit("An error occurred while connecting to the database server");
    }
}