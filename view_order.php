<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link rel="stylesheet" href="css/view_order.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();

        if (isset($_GET["id"]) && isset($_SESSION["Customer"]))
        {
            $orderId = $_GET["id"];
            $customer = $_SESSION["Customer"];
            $orders = getOrdersFromEmail($customer->Email);
            $order = $orders[$orderId-1];
            $books = getBooksFromOrder($orderId);

            $date = new DateTime($order->Date);
            $date = $date->format('d-m-Y');
            
            echo "<h2 class='title'> Order: $date - £$order->Total</h2>";    


            echo "<div id='grid'>";
            foreach ($books as $book)
            {
                $html = "
                <a href='view_book.php?id=" .$book->BookID."'>
                    <div class='book'>
                        <img src='$book->ImagePath' class='book-image'>
                        <h1 class='book-title'>$book->Title</h1>
                        <h2 class='price'>£$book->Price</h2>
                    </div>
                </a>
                ";

                echo $html;
            }
            echo "</div>";

            $returnButton = "
            <div class='container'>
                <a href='account.php'>
                    <button type='button' class='returnButton'>Back to account</button>
                </a>
            </div>
            ";
            echo $returnButton;
        }

    ?>
</body>
</html>