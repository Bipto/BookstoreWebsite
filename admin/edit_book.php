<?php

    function createEditBooksScreen()
    {
        require_once "php/database/database_connections.php";

        $id = $_GET["id"];
        $book = getBookById($id);

        $title = htmlspecialchars($book->Title, ENT_QUOTES);
        $author = htmlspecialchars($book->Author, ENT_QUOTES);
        $description = htmlspecialchars($book->Description, ENT_QUOTES);
        $genre = htmlspecialchars($book->Genre, ENT_QUOTES);

        $html = 
        "
        <form action='admin_dashboard.php?action=updated&id=$id' method='post' class='form'>
            <h2>Edit Book</h2>

            <img src='$book->ImagePath' class='image'><br>

            <label for='title' type='text'  class='label'>Title:</label><br>
            <input type='text' id='title' name='title' class='entry' value='$title'><br>
        
            <label for='author' type='text' class='label'>Author:</label><br>
            <input type='text' id='author' name='author' class='entry' value='$author'><br>

            <label for='description' type='text' class='label'>Description:</label><br>
            <input type='text' id='description' name='description' class='entry' value='$description'><br>

            <label for='genre' type='text' class='label'>Genre:</label><br>
            <input type='text' id='genre' name='genre' class='entry' value='$genre'><br>

            <label for='price' type='text' class='label'>Price:</label><br>
            <input type='number' min='0.1' step='any' name='price' class='entry' value='$book->Price'/><br>

            <label for='path' type='text' class='path'>Image Path:</label><br>
            <input type='text' id='path' name='path' class='entry' value='$book->ImagePath'><br><br>

            <button type='button' class='deleteButton' onclick='removeBookFromDatabase($book->BookID)'>Delete</button>
            <input type='submit' value='Update' class='submitButton'>

            <br><br>
        </form>
        ";

        echo $html;
    }

?>