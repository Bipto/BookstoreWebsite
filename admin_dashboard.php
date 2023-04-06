<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
    <script defer type="text/javascript" src="js/main.js"></script>
    <link rel="icon" href="img/logo.png">
</head>
<body>    
    <div class="titlebar" id="titlebar">        
        <h1 class="title">Selby Bookstore Admin Dashboard</h1><br>

        <a href="javascript:void(0);" class="icon" onclick="toggleAdminDropdownMenu()">
            <i class="fa fa-bars" id="hamburger"></i>
        </a>
    </div>

    <div class="container" id="container">
        <div class="navigation" id="navigation">
            <a href="admin_dashboard.php?action=manage">
                <button type="button" class="nav-button">Manage Books</button><br>
            </a>
            <a href="admin_dashboard.php?action=add">
                <button type="button" class="nav-button">Add Book</button><br>
            </a>
            <a href="index.php">
                <button type="button"class="nav-button">Return to homepage</button>
            </a>
        </div>
    
        <div class="content">
            <?php
                require_once "php/database/administrator.php";
                require_once "admin/manage_books.php";
                require_once "admin/add_book.php";
                require_once "admin/remove_book.php";
                require_once "admin/edit_book.php";
                require_once "admin/update_book.php";
                require_once "admin/insert_book.php";

                session_start();

                if (!isset($_SESSION["Admin"]))
                {
                    die("Not logged in as an administrator!");
                }            

                $searchText = "";
                if (isset($_GET["name"]))
                {
                    $searchText = $_GET["name"];
                }
                
                if (isset($_GET["action"]))
                {
                    $action = $_GET["action"];
                    if ($action === "manage")
                        createManageBooksScreen($searchText);
                    else if ($action === "add")
                        createAddBookScreen();
                    else if ($action === "remove")
                        createRemoveBookScreen();
                    else if ($action === "edit")
                        createEditBooksScreen();
                    else if ($action === "updated")
                        createBookUpdatedScreen();
                    else if ($action === "inserted")
                        createBookInsertedScreen();
                    else
                        echo "Invalid action entered!";   
                }                
            ?> 
        </div>
    </div>
</body>
</html>