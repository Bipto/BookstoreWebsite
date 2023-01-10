<?php

    require_once "database_connections.php";

    function createDatabase($conn)
    {
        //create database statement
        $sql = "CREATE DATABASE Bookstore";

        //attempt to execute query
        if ($conn->query($sql) === TRUE)
        {
            echo "Database created successfully";
        }
        else
        {
            echo "Error creating database: " . $conn->error;
        }

        echo "<br>";
    }

    function createBooksTable($conn){
        $create_books_sql = "CREATE TABLE Bookstore.Books(
            BookID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            Title VARCHAR(50),
            Author VARCHAR(50),
            BookDescription TEXT,
            Genre VARCHAR(30),
            Price DECIMAL(6,2),
            ImagePath VARCHAR(150)
            )";
    
        if ($conn->query($create_books_sql) === TRUE){
            echo "Table Books created successfully";
        }
        else{
            echo "Error creating table (Books): " . $conn->error;
        }

        echo "<br>";
    }

    function createAdminTable($conn){
        $create_administrators_sql = "CREATE TABLE Bookstore.Administrators(
            Email VARCHAR(50) PRIMARY KEY NOT NULL,
            Title VARCHAR(10),      
            FirstName VARCHAR(30),
            Surname VARCHAR(50),
            DateOfBirth DATETIME,
            HouseNumber VARCHAR(30),
            Street VARCHAR(50),
            Town VARCHAR(50),
            County VARCHAR(50),
            Country VARCHAR(50),
            PostCode VARCHAR(7)
            )";
    
        if ($conn->query($create_administrators_sql) === TRUE){
            echo "Table Administrators created successfully";
        }
        else{
            echo "Error creating table (Administrators): " . $conn->error;
        }

        echo "<br>";    
    }

    function createCustomerTable($conn){
        $create_customers_sql = "CREATE TABLE Bookstore.Customers(
            Email VARCHAR(50) PRIMARY KEY NOT NULL,
            Title VARCHAR(10),
            FirstName VARCHAR(30),
            Surname VARCHAR(50),
            DateOfBirth DATETIME,
            HouseNumber VARCHAR(30),
            Street VARCHAR(50),
            Town VARCHAR(50),
            County VARCHAR(50),
            Country VARCHAR(50),
            PostCode VARCHAR(7)
            )";

        if ($conn->query($create_customers_sql) === TRUE){
            echo "Table Customers created successfully";
        }
        else{
            echo "Error creating table (Customers): " . $conn->error;
        }

        echo "<br>";
    }

    function createOrdersTable($conn){
        $create_orders_sql = "CREATE TABLE Bookstore.Orders(
            OrderID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            Email VARCHAR(50) NOT  NULL,
            FOREIGN KEY (Email) REFERENCES Bookstore.Customers(Email),
            Total DECIMAL(6,2),
            Date DATETIME
            )";

        if ($conn->query($create_orders_sql) === TRUE){
            echo "Table Orders created successfully";
        }
        else{
            echo "Error creating table (Orders): " . $conn->error;
        }

        echo "<br>";
    }
    
    function createBookSalesTable($conn){
        $create_book_sales_sql = "CREATE TABLE Bookstore.BookSales(
            BookSaleID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            BookID INT UNSIGNED NOT NULL,
            FOREIGN KEY (BookID) REFERENCES Bookstore.Books(BookID),
            OrderID INT UNSIGNED,
            FOREIGN KEY (OrderID) REFERENCES Bookstore.Orders(OrderID)
            )";

        if ($conn->query($create_book_sales_sql) === TRUE){
            echo "Table BookSales created successfully";
        }
        else{
            echo "Error creating table (BookSales): " . $conn->error;
        }

        echo "<br>";
    }

    $conn = openConnection();
    
    createDatabase($conn);
    createBooksTable($conn);
    createAdminTable($conn);
    createCustomerTable($conn);
    createOrdersTable($conn);
    createBookSalesTable($conn);

    //close connection to database
    $conn->close();
    
?>