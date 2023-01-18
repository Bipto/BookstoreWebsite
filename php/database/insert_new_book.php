<?php
    require_once "database_connections.php";

    $conn = openConnection();

    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $imagePath = $_POST["imagePath"];

    $stmt = $conn->prepare("INSERT INTO Bookstore.Books(Title, Author, BookDescription, Genre, Price, ImagePath)
    VALUES(?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssds", $title, $author, $genre, $description, $price, $imagePath);

    if ($stmt->execute() === TRUE){
        echo "Data inserted";
    }
    else{
        echo "Data could not be inserted: " . $conn->error;
    }

    echo "<br>";
 
    $conn->close();
?>