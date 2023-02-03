<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <script type="text/javascript" src="js/main.js"></script>
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
        <h1 class="title">Selby Bookstore Admin Dashboard</h1><br>
    </div>


    <div class="container">
        <div class="navigation">
            <a href="admin_dashboard.php?action=manage">
                <button type="button" class="nav-button">Manage Books</button><br>
            </a>
            <a href="admin_dashboard.php?action=add">
                <button type="button" class="nav-button">Add Book</button><br>
            </a>
            <a href="admin_dashboard.php?action=remove">
                <button type="button" class="nav-button">Remove Book</button><br>
            </a>
            <a href="index.php">
                <button type="button"class="nav-button">Back</button>
            </a>
        </div>
    
        <div class="content">
            <?php
                require_once "admin/manage_books.php";
                require_once "admin/add_book.php";
                require_once "admin/remove_book.php";

                $action = $_GET["action"];
                if ($action === "manage")
                    createManageBooksScreen();
                else if ($action === "add")
                    createAddBookScreen();
                else if ($action === "remove")
                    createRemoveBookScreen();
                else
                    echo "Invalid action entered!";              

  
            ?> 
        </div>
    </div>
</body>
</html>