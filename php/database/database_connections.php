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
            echo $book->Title. " inserted <br>";
        }
        else{
            echo "Data could not be inserted: " . $conn->error;
        }
    }

    function getBookById($bookID)
    {
        $conn = openConnection();
        
        $sql = "SELECT BookID, Title, Author, BookDescription, Genre, Price, ImagePath FROM Bookstore.Books WHERE BookID = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("i", $bookID);
        $query->execute();

        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $book = new Book();
            $book->BookID = $row["BookID"];
            $book->Title = $row["Title"];
            $book->Author = $row["Author"];
            $book->Description = $row["BookDescription"];
            $book->Genre = $row["Genre"];
            $book->Price = $row["Price"];
            $book->ImagePath = $row["ImagePath"];
        }

        $conn->close();
        return $book;
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

    function addBookToCart($customer, $bookID)
    {
        $conn = openConnection();

        $sql = "INSERT INTO Bookstore.Carts(Email, BookID)
        VALUES(?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("si", $customer->Email,  $bookID);

        if ($query->execute() === FALSE){
            echo "Data could not be inserted: " . $conn->error;
        }

        $conn->close();
    }

    function getBooksInCart($customer)
    {
        $books = array();
        
        $conn = openConnection();
        $sql = "
            SELECT Bookstore.Carts.CartID, Bookstore.Books.BookID, Bookstore.Books.Title, Bookstore.Books.Author, Bookstore.Books.BookDescription, Bookstore.Books.Genre, Bookstore.Books.Price, Bookstore.Books.ImagePath
            FROM Bookstore.Carts
            INNER JOIN Bookstore.Books ON Bookstore.Carts.BookID = Bookstore.Books.BookID
            WHERE Bookstore.Carts.Email = '" .$customer->Email. "';
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $cartItem = new CartBook();
                    $cartItem->CartID = $row["CartID"];
                    $cartItem->Book = new Book();
                    $cartItem->Book->BookID = $row["BookID"];
                    $cartItem->Book->Title = $row["Title"];
                    $cartItem->Book->Author = $row["Author"];
                    $cartItem->Book->Description = $row["BookDescription"];
                    $cartItem->Book->Genre = $row["Genre"];
                    $cartItem->Book->Price = $row["Price"];
                    $cartItem->Book->ImagePath = $row["ImagePath"];
    
                    array_push($books, $cartItem);
                }
            }
    
            $conn->close();
    
            return $books;
    }

    function removeBookFromCart($cartID)
    {
        $conn = openConnection();

        $sql = "DELETE FROM Bookstore.Carts WHERE CartID=$cartID";

        if ($conn->query($sql) !== TRUE){
            echo "Error removing book: " . $conn->error;
        }

        $conn->close();
    }

?>