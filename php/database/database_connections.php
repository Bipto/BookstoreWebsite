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

    function insertOrder($order)
    {
        $conn = openConnection();

        $sql = 
        "
        INSERT INTO Bookstore.Orders(AccountEmail, Total, Date, OrderEmail, HouseNumber, Street, County, Country, PostCode)
        VALUES ('$order->AccountEmail', $order->Total, '$order->Date', '$order->OrderEmail', '$order->HouseNumber', '$order->Street', '$order->County', '$order->Country', '$order->PostCode')
        ";

        if ($conn->query($sql) !== TRUE)
            echo "Could not create order: " .$conn->error;

        $conn->close();
    }

    function insertBooksSales($orderID, $books)
    {
        $conn = openConnection();

        foreach ($books as $book)
        {
            $sql = "
            INSERT INTO Bookstore.BookSales(BookID, OrderID)
            VALUES(?, ?);
            ";

            $query = $conn->prepare($sql);
            $query->bind_param("ii", $book->Book->BookID, $orderID);

            if ($query->execute() === FALSE)
                echo "Could not insert book sale: " .$conn->error;
        }

        $conn->close();
    }

    function clearCart($email)
    {
        $conn = openConnection();

        $sql = "DELETE FROM Bookstore.Carts WHERE Email = ?";

        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);

        if ($query->execute() === FALSE)
            echo "Could not remove book from cart";

        $conn->close();
    }

    function getMostRecentOrderID()
    {
        $orderID = -1;
        $conn = openConnection();

        $sql = 
        "
            SELECT OrderID FROM Bookstore.Orders
            ORDER BY OrderID DESC
            LIMIT 0,1
        ";

        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $orderID = $row["OrderID"];
        }
        
        $conn->close();

        return $orderID;
    }

    function getOrdersFromEmail($email)
    {
        $conn = openConnection();

        $sql = "SELECT Total, Date FROM Bookstore.Orders WHERE AccountEmail = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $orders = array();

        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $total = $row["Total"];
                $date = $row["Date"];
                $text = "$date - £$total";
                array_push($orders, $text);
            }
        }

        $conn->close();

        return $orders;
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

    function addBookToCart($email, $bookID)
    {
        $conn = openConnection();

        $sql = "INSERT INTO Bookstore.Carts(Email, BookID)
        VALUES(?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("si", $email,  $bookID);

        if ($query->execute() === FALSE){
            echo "Data could not be inserted: " . $conn->error;
        }

        $conn->close();
    }

    function getBooksInCart($email)
    {
        $books = array();
        
        $conn = openConnection();
        $sql = "
            SELECT Bookstore.Carts.CartID, Bookstore.Books.BookID, Bookstore.Books.Title, Bookstore.Books.Author, Bookstore.Books.BookDescription, Bookstore.Books.Genre, Bookstore.Books.Price, Bookstore.Books.ImagePath
            FROM Bookstore.Carts
            INNER JOIN Bookstore.Books ON Bookstore.Carts.BookID = Bookstore.Books.BookID
            WHERE Bookstore.Carts.Email = '" .$email. "';
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