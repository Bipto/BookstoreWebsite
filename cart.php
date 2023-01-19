<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";
        createHeader();

        $customer = $_SESSION["Customer"];

        if (isset($_GET["id"]))
        {
            $bookID = $_GET["id"];
            addBookToCart($customer, $bookID);
        }

        $books = getBooksInCart($customer);

        echo "<div class='container' id='container'>";

        if (count($books) == 0)
            echo '
                <div class="no-book-info">
                    <h4 class="book-info">No books in cart</h4>
                </div>
            ';

        $orderTotal = 0.0;
        foreach ($books as $book)
        {
            $bookPrice = number_format((float)$book->Book->Price, 2, '.', '');

            $html = "
                <div class='item'>
                    <img src= '{$book->Book->ImagePath}' class='book-image'>
                    <h4 class='book-info'> {$book->Book->Title} </h4>
                    <h4 class='book-info'> £$bookPrice </h4>
                    <input type='button' value='Remove' class='remove-button' onclick='removeBookFromCart($book->CartID)'>
                </div>
            ";
            echo $html;

            echo"";

            $orderTotal += $book->Book->Price;
        }

        echo"</div>";
        
        $orderTotalDisplay = number_format((float)$orderTotal, 2, '.', '');
        echo "<h1 class='order-total'> Total: £$orderTotalDisplay </h1>";

    ?>
</body>
</html>