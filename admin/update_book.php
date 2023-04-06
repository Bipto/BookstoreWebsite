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
        updateBook($book);
    }

?>