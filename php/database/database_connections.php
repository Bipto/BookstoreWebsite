<?php

    require_once "book.php";

    function openConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        //create the initial connection
        $conn = new mysqli($servername, $username, $password);

        //validate connection
        if ($conn->connect_error)
        {
            die ("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function insertBook($book, $conn)
    {
        $stmt = $conn->prepare("INSERT INTO Bookstore.Books(Title, Author, BookDescription, Genre, Price, ImagePath)
        VALUES(?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssds", $book->Title, $book->Author, $book->Description, $book->Genre, $book->Price, $book->ImagePath);

        if ($stmt->execute() === TRUE){
            echo $book->Title. "inserted <br>";
        }
        else{
            echo "Data could not be inserted: " . $conn->error;
        }
    }
    
    function getBooks()
    {
        $conn = openConnection();
        $books = array();
        
        $sql = "SELECT BookID, Title, Author, BookDescription, Genre, Price, ImagePath FROM Bookstore.Books";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $book = new Book();
                $book->BookID = $row["BookID"];
                $book->Title = $row["Title"];
                $book->Author = $row["Author"];
                $book->Description = $row["BookDescription"];
                $book->Genre = $row["Genre"];
                $book->Price = $row["Price"];
                $book->ImagePath = $row["ImagePath"];

                array_push($books, $book);
            }
        }

        $conn->close();

        return $books;
    }

?>