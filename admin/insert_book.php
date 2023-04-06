<?php      

    function createBookInsertedScreen()
    {
        require_once "php/database/database_connections.php";
        require_once "php/database/book.php";
    
        $book = new Book();
        $book->BookID = 0;
        $book->Title = $_POST["title"];
        $book->Author = $_POST["author"];
        $book->Genre = $_POST["genre"];
        $book->Price = $_POST["price"];
        $book->Description = $_POST["description"];
        $book->ImagePath = $_POST["path"];

        echo "<h2>Inserting Book</h2>";    

        if (strlen($book->Title) > 0 &&
            strlen($book->Author) > 0 &&
            strlen($book->Genre) > 0 &&
            strlen($book->Description))
        {
            insertBook($book);
        }
        else
        {
            echo "Please try again. Some inputs were left empty.";
        }
    }

?>