<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
    <link rel="stylesheet" href="css/view_book.css">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";
        require_once "php/database/book.php";

        createHeader();
        $id = $_GET["id"];
        $selectedBook = getBookById($id);

        $bookInfo = "
        <div class='book'>
            <img src=" .$selectedBook->ImagePath. " class='book-image' >
            <h2>" .$selectedBook->Title. " - " .$selectedBook->Author.  "</h2>
            <h3>" .$selectedBook->Genre. "</h3>
            <h3> £" .$selectedBook->Price. "</h3>
            <div class='description'>" .$selectedBook->Description. "</div>
        </div>
        ";

        echo $bookInfo;

        if (isset($_SESSION["Customer"]))
        {
            echo "<a href='cart.php?id=".$selectedBook->BookID."'>
                <button type='button' class='button'>Add to cart</button>
            </a>";
        }
        else
        {
            echo "<a href='sign_in.php'>
                <button type='button' class='button'>Add to cart</button>
            </a>";
        }
    ?>

    <!-- <a href="cart.php?id=".$book->BookID."">
        <button type="button" class="button">Add to cart</button>
    </a> -->

</body>
</html>