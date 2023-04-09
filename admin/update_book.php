<?php

    function createBookUpdatedScreen()
    {
        require_once "php/database/database_connections.php";

        $id = $_GET["id"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $description = $_POST["description"];
        $genre = $_POST["genre"];
        $price = $_POST["price"];
        $imagePath = $_POST["path"];

        $book = new Book();
        $book->BookID = $id;
        $book->Title = $title;
        $book->Author = $author;
        $book->Description = $description;
        $book->Genre = $genre;
        $book->Price = $price;
        $book->ImagePath = $imagePath;

        echo "<h2>Updating Book</h2>";

        if (strlen($book->Title > 0) &&
            strlen($book->Author > 0) &&
            strlen($book->Genre > 0) &&
            strlen($book->Description) > 0)
        {
            updateBook($book);
        }
        else
        {
            echo "Please try again. Some inputs were left empty.";
        }
    }

?>