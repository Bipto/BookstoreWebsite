<?php

    require_once "book.php";
    require_once "order.php";

    ///--------------------------------------------------------
    ///           OPEN CONNECTION TO MYSQL DATABASE
    ///--------------------------------------------------------
    
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

    ///--------------------------------------------------------
    ///             INSERT BOOK INTO DATABASE
    ///--------------------------------------------------------

    function insertBook($book)
    {
        $conn = openConnection();

        $stmt = $conn->prepare(
        "INSERT INTO Bookstore.Books(
            Title,
            Author,
            BookDescription,
            Genre,
            Price,
            StockCount,
            ImagePath)
        VALUES(?, ?, ?, ?, ?, ?, ?)"
        );
        
        $stmt->bind_param("ssssdis", 
            $book->Title,
            $book->Author,
            $book->Description,
            $book->Genre,
            $book->Price,
            $book->StockCount,
            $book->ImagePath);

        if ($stmt->execute() === TRUE){
            echo $book->Title. " inserted <br>";
        }
        else{
            echo "Data could not be inserted: " . $conn->error;
        }

        $conn->close();
    }

    ///--------------------------------------------------------
    ///             INSERT ADMIN INTO DATABASE
    ///--------------------------------------------------------

    function insertAdmin($admin)
    {
        $conn = openConnection();

        $stmt = $conn->prepare(
            "INSERT INTO Bookstore.Administrators(
                Email,
                Title,
                FirstName,
                Surname,
                DateOfBirth,
                HouseNumber,
                Street,
                Town,
                County,
                Country,
                PostCode,
                Password
                )
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

        $stmt->bind_param("ssssssssssss",
            $admin->Email,
            $admin->Title,
            $admin->FirstName,
            $admin->Surname,
            $admin->DateOfBirth,
            $admin->HouseNumber,
            $admin->Street,
            $admin->Town,
            $admin->County,
            $admin->Country,
            $admin->PostCode,
            $admin->Password
        );

        if ($stmt->execute() === TRUE){
            echo $admin->Email . " created successfully.<br>";
        }
        else{
            echo "Data could not be inserted: " . $conn->error;
        }

        $conn->close();
    }

    ///--------------------------------------------------------
    ///            INSERT CUSTOMER INTO DATABASE
    ///--------------------------------------------------------
    
    function insertCustomer($customer)
    {
        $conn = openConnection();

        $stmt = $conn->prepare(
            "INSERT INTO Bookstore.Customers(
                Email,
                Title,
                FirstName,
                Surname,
                DateOfBirth,
                HouseNumber,
                Street,
                Town,
                County,
                Country,
                PostCode,
                Password
                )
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

        $stmt->bind_param("ssssssssssss",
            $customer->Email,
            $customer->Title,
            $customer->FirstName,
            $customer->Surname,
            $customer->DateOfBirth,
            $customer->HouseNumber,
            $customer->Street,
            $customer->Town,
            $customer->County,
            $customer->Country,
            $customer->PostCode,
            $customer->Password
        );

        if ($stmt->execute() !== TRUE){
            echo "Data could not be inserted: " . $conn->error;
            return false;
        }

        $conn->close();

        return true;
    }

    ///--------------------------------------------------------
    ///                   INSERT ORDER
    ///--------------------------------------------------------
    function insertOrder($order)
    {
        $conn = openConnection();

        $stmt = $conn->prepare(
            "INSERT INTO Bookstore.Orders(
                AccountEmail,
                Total,
                Date,
                OrderEmail,
                HouseNumber,
                Street,
                County,
                Country,
                PostCode
                )
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

        $stmt->bind_param("sssssssss",
            $order->AccountEmail,
            $order->Total,
            $order->Date,
            $order->OrderEmail,
            $order->HouseNumber,
            $order->Street,
            $order->County,
            $order->Country,
            $order->PostCode
        );

        if ($stmt->execute() !== TRUE)
        {
            echo "Could not create order: " .$conn->error;
        }

        $conn->close();
    }

    ///--------------------------------------------------------
    ///             INSERT BOOKSALE INTO DATABASE
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///           DECREMENT BOOK STOCK COUNT
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///                INCREASE STOCK COUNT
    ///--------------------------------------------------------

    function increaseStockCount($book)
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

    ///--------------------------------------------------------
    ///             UPDATE CUSTOMER DETAILS
    ///--------------------------------------------------------

    function updateCustomerDetails($customer)
    {
        $conn = openConnection();

        $stmt = $conn->prepare("
            UPDATE Bookstore.Customers
            SET
                Title = (?),
                FirstName = (?),
                Surname = (?),
                DateOfBirth = (?),
                HouseNumber = (?),
                Street = (?),
                Town = (?),
                County = (?),
                Country = (?),
                PostCode = (?),
                Password = (?)
            WHERE Email = (?)"
            );

        $stmt->bind_param("ssssssssssss",
            $customer->Title,
            $customer->FirstName,
            $customer->Surname,
            $customer->DateOfBirth,
            $customer->HouseNumber,
            $customer->Street,
            $customer->Town,
            $customer->County,
            $customer->Country,
            $customer->PostCode,
            $customer->Password,
            $customer->Email
        );

        if ($stmt->execute() !== TRUE)
        {
            die ("Error updating customer: " . $conn->error);
            return false;
        }
        
        $conn->close();
        return true;
    }

    ///--------------------------------------------------------
    ///             UPDATE CUSTOMER PASSWORD
    ///--------------------------------------------------------
    
    function updateCustomerPassword($customer, $newPassword)
    {
        $conn = openConnection();

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            UPDATE Bookstore.Customers
            SET
                Password = (?)
            WHERE Email = (?)"
            );

        $stmt->bind_param("ss",
            $hashedPassword,
            $customer->Email
        );

        if ($stmt->execute() !== TRUE)
        {
            die ("Error updating customer: " . $conn->error);
            return false;
        }

        $conn->close();
        return true;
    }

    ///--------------------------------------------------------
    ///                     CLEAR CART
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///             GET MOST RECENT ORDER
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///             GET ORDERS FROM EMAIL
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///            GET BOOK INFORMATION FROM ID
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///             GET BOOKID FROM CARTID
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///          GET ADMIN INFO FROM LOGIN DETAILS
    ///--------------------------------------------------------

    function getAdminFromDetails($email, $password)
    {
        $conn = openConnection();

        $sql = "SELECT * FROM Bookstore.Administrators WHERE Email = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["Password"];

            if (password_verify($password, $hashedPassword))
            {
                $admin = new Admin();
                $admin->Email = $row["Email"];
                $admin->FirstName = $row["FirstName"];
                $admin->Surname = $row["Surname"];
                $admin->DateOfBirth = $row["DateOfBirth"];
                $admin->HouseNumber = $row["HouseNumber"];
                $admin->Street = $row["Street"];
                $admin->Town = $row["Town"];
                $admin->County = $row["County"];
                $admin->Country = $row["Country"];
                $admin->PostCode = $row["PostCode"];
                return $admin;
            }
        }

        $conn->close();

        return null;
    }

    ///--------------------------------------------------------
    ///         GET CUSTOMER INFO FROM LOGIN DETAILS
    ///--------------------------------------------------------

    function getCustomerFromDetails($email, $password)
    {
        $conn = openConnection();

        $sql = "SELECT * FROM Bookstore.Customers WHERE Email = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["Password"];

            if (password_verify($password, $hashedPassword))
            {
                $customer = new Customer();
                $customer->Email = $row["Email"];
                $customer->FirstName = $row["FirstName"];
                $customer->Surname = $row["Surname"];
                $customer->DateOfBirth = $row["DateOfBirth"];
                $customer->HouseNumber = $row["HouseNumber"];
                $customer->Street = $row["Street"];
                $customer->Town = $row["Town"];
                $customer->County = $row["County"];
                $customer->Country = $row["Country"];
                $customer->PostCode = $row["PostCode"];
                return $customer;
            }
        }

        $conn->close();
        return null;
    }

    ///--------------------------------------------------------
    ///             GET ALL BOOKS IN DATABASE
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///                 ADD A BOOK TO CART
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///            GET BOOKS IN CUSTOMERS CART
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///               GET BOOKS IN AN ORDER
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///                 REMOVE BOOK FROM CART
    ///--------------------------------------------------------

    function removeBookFromCart($cartID)
    {
        $conn = openConnection();

        $sql = "DELETE FROM Bookstore.Carts WHERE CartID=$cartID";

        if ($conn->query($sql) !== TRUE){
            echo "Error removing book: " . $conn->error;
        }

        $conn->close();
    }

    ///--------------------------------------------------------
    ///             UPDATE BOOK INFORMATION
    ///--------------------------------------------------------

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

    ///--------------------------------------------------------
    ///             REMOVE BOOK FROM BOOK TABLE
    ///--------------------------------------------------------

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