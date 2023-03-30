<?php

    require_once "book.php";
    require_once "order.php";

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
        $stmt = $conn->prepare("INSERT INTO Bookstore.Books(Title, Author, BookDescription, Genre, Price, StockCount, ImagePath)
        VALUES(?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssdis", $book->Title, $book->Author, $book->Description, $book->Genre, $book->Price, $book->StockCount, $book->ImagePath);

        if ($stmt->execute() === TRUE){
            echo $book->Title. " inserted <br>";
        }
        else{
            echo "Data could not be inserted: " . $conn->error;
        }
    }

    function insertAdmin($admin, $conn)
    {
        $sql = 
            "
            INSERT INTO Bookstore.Administrators(Email, Title, FirstName, Surname, DateOfBirth, HouseNumber, Street, Town, County, Country, PostCode, Password)
            VALUES ('$admin->Email', '$admin->Title', '$admin->FirstName', '$admin->Surname', '$admin->DateOfBirth', '$admin->HouseNumber', '$admin->Street', '$admin->Town', '$admin->County', '$admin->Country', '$admin->PostCode', '$admin->Password')
            ";

        if ($conn->query($sql) === TRUE)
            echo "Default admin created successfully";
        else
            echo "Default admin could not be created: " . $conn->error;
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

    function insertBookSales($orderID, $bookSales)
    {
        $conn = openConnection();

        foreach ($bookSales as $bookSale)
        {
            $sql = "
            INSERT INTO Bookstore.BookSales(BookID, OrderID)
            VALUES(?, ?);
            ";

            $query = $conn->prepare($sql);
            $query->bind_param("ii", $bookSale->Book->BookID, $orderID);

            if ($query->execute() === FALSE)
                echo "Could not insert book sale: " .$conn->error;
        }

        $conn->close();
    }

    function reduceOrderStockCount($bookSales)
    {
        $conn = openConnection();

        foreach ($bookSales as $bookSale)
        {
            $newStockCount = $bookSale->Book->StockCount-1;

            $sql = "
            UPDATE Bookstore.Books
            SET StockCount = (?)
            WHERE BookID = (?)
            ";

            $query = $conn->prepare($sql);
            $query->bind_param("ii", $newStockCount, $bookSale->Book->BookID);

            if ($query->execute() === FALSE)
                echo "Could not reduce stock count: " .$conn->error;
        }

        $conn->close();
    }

    function reduceIndividualStockCount($book)
    {
        echo "reducing stock count";
        $conn = openConnection();

        $newStockCount = $book->StockCount-1;

        $sql = "
        UPDATE Bookstore.Books
        SET StockCount = (?)
        WHERE BookID = (?)        
        ";

        $query = $conn->prepare($sql);
        $query->bind_param("ii", $newStockCount, $book->BookID);

        if ($query->execute() === FALSE)
            echo "Could not reduce stock count: " .$conn->error;

        $conn->close();
    }

    function increaseIndividualStockCount($book)
    {
        $conn = openConnection();

        $newStockCount = $book->StockCount+1;

        $sql = "
        UPDATE Bookstore.Books
        SET StockCount = (?)
        WHERE BookID = (?)        
        ";

        $query = $conn->prepare($sql);
        $query->bind_param("ii", $newStockCount, $book->BookID);

        if ($query->execute() === FALSE)
            echo "Could not reduce stock count: " .$conn->error;

        $conn->close();
    }

    function updateCustomerDetails($customer)
    {
        $conn = openConnection();

        $sql = "
        UPDATE Bookstore.Customers
        SET
            Title = '$customer->Title',
            FirstName = '$customer->FirstName',
            Surname = '$customer->Surname',
            DateOfBirth = '$customer->DateOfBirth',
            HouseNumber = '$customer->HouseNumber',
            Street = '$customer->Street',
            Town = '$customer->Town',
            County = '$customer->County',
            Country = '$customer->Country',
            PostCode = '$customer->PostCode' 
        WHERE Email = '$customer->Email'";

        if ($conn->query($sql) !== TRUE)
        {
            die("Error updating customer: " . $conn->error);
            return false;
        }
        
        $conn->close();
        return true;
    }

    function updateCustomerPassword($customer, $password)
    {
        $conn = openConnection();;

        $hashedPassword = password_hash($customer->Password, PASSWORD_DEFAULT);

        $sql = "
        UPDATE Bookstore.Customers
        SET
            Password = '$hashedPassword'
        WHERE Email = '$customer->Email'
        ";

        if ($conn->query($sql) !== TRUE)
        {
            die ("Error updating password: " . $conn->error);
            return false;
        }

        $conn->close();
        return true;
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

        $sql = "SELECT OrderID, Total, Date FROM Bookstore.Orders WHERE AccountEmail = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $orders = array();

        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $order = new Order();
                $order->OrderID = $row["OrderID"];
                $order->Total = $row["Total"];
                $order->Date = $row["Date"];

                array_push($orders, $order);
            }
        }

        $conn->close();

        return $orders;
    }

    function getBookById($bookID)
    {
        $conn = openConnection();
        
        $sql = "SELECT BookID, Title, Author, BookDescription, Genre, Price, StockCount, ImagePath FROM Bookstore.Books WHERE BookID = ?";
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
            $book->StockCount = $row["StockCount"];
            return $book;
        }

        $conn->close();
        return null;
    }

    function getBookByCartID($cartID)
    {
        $conn = openConnection();

        $sql = "SELECT BookID FROM Bookstore.Carts WHERE CartID = ($cartID)";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $bookId = $row["BookID"];
            return getBookById($bookId);
        }

        $conn->close();

        return null;
    }

    function getBooks()
    {
        $conn = openConnection();
        $books = array();
        
        $sql = "SELECT BookID, Title, Author, BookDescription, Genre, Price, StockCount, ImagePath FROM Bookstore.Books";
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
                $book->StockCount = $row["StockCount"];

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
            SELECT 
                Bookstore.Carts.CartID,
                Bookstore.Books.BookID,
                Bookstore.Books.Title,
                Bookstore.Books.Author,
                Bookstore.Books.BookDescription,
                Bookstore.Books.Genre,
                Bookstore.Books.Price,
                Bookstore.Books.ImagePath,
                Bookstore.Books.StockCount
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
                $cartItem->Book->StockCount = $row["StockCount"];

                array_push($books, $cartItem);
            }
        }

        $conn->close();

        return $books;
    }

    function getBooksFromOrder($orderId)
    {
        $books = array();
        $conn = openConnection();

        $sql = "
        SELECT Bookstore.Books.BookID, Title, Author, BookDescription, Genre, Price, ImagePath, StockCount
        FROM Bookstore.Books
        INNER JOIN Bookstore.BookSales
        ON Bookstore.Books.BookID = Bookstore.BookSales.BookID
        WHERE Bookstore.BookSales.OrderID = $orderId
        ";

        if ($result = $conn->query($sql))
        {
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
                    $book->StockCount = $row["StockCount"];
    
                    array_push($books, $book);
                }
            }
        }
        else
        {
            echo $conn->error;
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

    function updateBook($book)
    {
        $conn = openConnection();

        $title = htmlspecialchars($book->Title, ENT_QUOTES);
        $author = htmlspecialchars($book->Author, ENT_QUOTES);
        $description = htmlspecialchars($book->Description, ENT_QUOTES);
        $genre = htmlspecialchars($book->Genre, ENT_QUOTES);
        $price = htmlspecialchars($book->Price, ENT_QUOTES);
        $path = htmlspecialchars($book->ImagePath, ENT_QUOTES);

        $sql = "
        UPDATE Bookstore.Books
        SET 
            Title = '$title',
            Author = '$author',
            BookDescription = '$description',
            Genre = '$genre',
            Price = $price,
            ImagePath = '$path'
        WHERE BookID = $book->BookID
        ";

        if ($conn->query($sql) === TRUE)
        {
            echo "Book updated successfully";
        }
        else
        {
            echo "Error updating book: " . $conn->error;
        }

        $conn->close();
    }

    function removeBook($bookId)
    {
        $conn = openConnection();

        $sql = "DELETE FROM Bookstore.Books WHERE BookID = ?";

        $query = $conn->prepare($sql);
        $query->bind_param("i", $bookId);

        if ($query->execute() === TRUE)
            echo "Book removed from database";
        else
            echo "Book could not be removed from database: " .$conn->error;     

        $conn->close();
    }

?>