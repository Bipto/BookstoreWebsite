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
            Title VARCHAR(50) NOT NULL,
            Author VARCHAR(50) NOT NULL,
            BookDescription TEXT NOT NULL,
            Genre VARCHAR(30) NOT NULL,
            Price DECIMAL(6,2) NOT NULL,
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
            Title VARCHAR(10) NOT NULL,      
            FirstName VARCHAR(30) NOT NULL,
            Surname VARCHAR(50) NOT NULL,
            DateOfBirth DATETIME NOT NULL,
            HouseNumber VARCHAR(30)NOT NULL,
            Street VARCHAR(50) NOT NULL,
            Town VARCHAR(50) NOT NULL,
            County VARCHAR(50) NOT NULL,
            Country VARCHAR(50) NOT NULL,
            PostCode VARCHAR(7) NOT NULL,
            Password VARCHAR(255) NOT NULL
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
            Title VARCHAR(10) NOT NULL,
            FirstName VARCHAR(30) NOT NULL,
            Surname VARCHAR(50) NOT NULL,
            DateOfBirth DATETIME NOT NULL,
            HouseNumber VARCHAR(30) NOT NULL,
            Street VARCHAR(50) NOT NULL,
            Town VARCHAR(50) NOT NULL,
            County VARCHAR(50) NOT NULL,
            Country VARCHAR(50) NOT NULL,
            PostCode VARCHAR(7) NOT NULL,
            Password VARCHAR(255) NOT NULL
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
            Total DECIMAL(6,2) NOT NULL,
            Date DATETIME NOT NULL
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
            OrderID INT UNSIGNED NOT NULL,
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