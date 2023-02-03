<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>    

    <?php

        session_start();

        if (!isset($_SESSION["Admin"]))
        {
            die("Not logged in as an administrator!");
        }
    ?>


    <div class="titlebar">        
        <h1>Selby Bookstore Admin Dashboard</h1><br>
    </div>
    
    <a href="index.php">
        <input type="button" value="Back">
    </a>
</body>
</html>