<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>
    <?php

    require_once "php/layout.php";
    require_once "php/database/database_connections.php";
    require_once "php/database/order.php";

    $email = $_POST["email"];
    $houseNum = $_POST["houseNum"];
    $street = $_POST["street"];
    $town = $_POST["town"];
    $county = $_POST["county"];
    $country = $_POST["country"];
    $postcode = $_POST["postCode"];

    echo $email;
    echo $houseNum;
    echo $street;
    echo $town;
    echo $county;
    echo $country;
    echo $postcode;

    $order = $_SESSION["Order"];
    $order->OrderEmail = $email;
    $order->HouseNumber = $houseNum;
    $order->Street = $street;
    $order->Town = $town;
    $order->County = $county;
    $order->Country = $country;
    $order->PostCode = $postcode;

    createHeader();
    ?>

    <form action="payment_confirmed.php" method="post" class="form">
        <h3>Payment</h3>
        <label for="cardNum" id="cardNum" name="cardNum" class="entry">Card Number:</label><br>
        <input type="text" id="cardNum" name="cardNum" class="entry">
        <br><br>

        <label for="cardName" id="cardName" name="cardName" class="entry">Name on card:</label>        
        <input type="text" id="cardName" name="cardName" class="entry">
        <br><br>

        <label for="expiryDate" id="expiryDate" name="expiryDate">Expiry date:</label><br>
        <input type="date" id="expiryDate" name="expiryDate" class="entry">
        <br><br>

        <label for="securityCode" id="securityCode" name="securityCode">Security code:</label><br>
        <input type="text" id="securityCode" name="securityCode" class="entry">
        <br><br>

        <button type="button" onclick="paymentBackClick()">Back</button>
        <input type="submit" value="Submit" class="submitButton">
    </form>
</body>
</html>