<?php

    require_once "database/database_connections.php";
    require_once "database/create_database.php";

    $username = $_POST["email"];
    $password = $_POST["password"];

    echo $username;
    echo "<br>";
    echo $password;

    $conn = openConnection();
    createDatabase($conn);
?>