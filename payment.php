<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/payment.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";
        require_once "php/database/order.php";

        createHeader();

        $email = $_POST["email"];
        $houseNum = $_POST["houseNum"];
        $street = $_POST["street"];
        $town = $_POST["town"];
        $county = $_POST["county"];
        $country = $_POST["country"];
        $postcode = $_POST["postCode"];

        $order = $_SESSION["Order"];
        $order->OrderEmail = $email;
        $order->HouseNumber = $houseNum;
        $order->Street = $street;
        $order->Town = $town;
        $order->County = $county;
        $order->Country = $country;
        $order->PostCode = $postcode;

        $orderTotal = 0.0;
        $books = getBooksInCart($email);
        foreach ($books as $book)
        {
            $orderTotal += $book->Book->Price;
        }

        $html = '
        
        <form action="payment_confirmed.php" method="post" class="form">
            <h2>Payment</h2>
            <label for="cardNum" id="cardNum" name="cardNum" class="entry">Card Number:</label><br>
            <input type="text" id="cardNum" name="cardNum" class="entry">
            <br><br>

            <label for="cardName" id="cardName" name="cardName" class="entry">Name on card:</label><br>       
            <input type="text" id="cardName" name="cardName" class="entry">
            <br><br>

            <label for="expiryDate" id="expiryDate" name="expiryDate">Expiry date:</label><br>
            <input type="month" id="expiryDate" name="expiryDate" class="entry">
            <br><br>

            <label for="securityCode" id="securityCode" name="securityCode">Security code:</label><br>
            <input type="text" id="securityCode" name="securityCode" class="entry">
            <br><br>

            <h3>Order Total: £' .$orderTotal. '</h3>

            <button type="button" onclick="paymentBackClick() class="backButton">Back</button>
            <input type="submit" value="Submit" class="submitButton">
        </form>
        
        ';

        $order->Total = $orderTotal;
        $order->Date = date("Y/m/d");
        $order->Books = $books;

        echo $html;
    ?>

    
</body>
</html>