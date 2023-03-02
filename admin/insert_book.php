<?php      

    function createBookInsertedScreen()
    {
        require_once "php/database/database_connections.php";
        require_once "php/database/book.php";
    
        $title = $_POST["title"];
        $author = $_POST["author"];
        $description = $_POST["description"];
        $genre = $_POST["genre"];
        $price = $_POST["price"];
        $imagePath = $_POST["path"];
    
        $book = new Book();
        $book->BookID = 0;
        $book->Title = $title;
        $book->Author = $author;
        $book->Genre = $genre;
        $book->Price = $price;
        $book->Description = $description;
        $book->ImagePath = $imagePath;

        echo "<h2>Inserting Book</h2>";
    
        $conn = openConnection();
        insertBook($book, $conn);
        $conn->close();
    }

?>