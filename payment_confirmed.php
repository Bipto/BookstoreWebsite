<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmed</title>
    <link rel="stylesheet" href="css/payment_confirmed.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>

    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";
        require_once "php/database/order.php";

        createNavigation();

        $cardNum = $_POST["cardNum"];
        $cardName = $_POST["cardName"];
        $expiryDate = $_POST["expiryDate"];
        $securityCode = $_POST["securityCode"];

        $valid = TRUE;

        if (empty($cardNum))
        {
            echo "No card number was entered<br>";
            $valid = FALSE;
        }

        if (empty($cardName))
        {
            echo "No name was entered<br>";
            $valid = FALSE;
        }

        if (empty($expiryDate))
        {
            echo "No expiry date was entered<br>";
            $valid = FALSE;
        }

        if (empty($securityCode))
        {
            echo "No security code was entered<br>";
            $valid = FALSE;
        }

        if ($valid)
        {
            echo "<h3>Payment confirmed</h3>";
            
            $order = $_SESSION["Order"];
            insertOrder($order);
            $orderID = getMostRecentOrderID();          

            insertBookSales($orderID, $order->Books);
            reduceOrderStockCount($order->Books);
            clearCart($order->AccountEmail);
        }

    ?>
</body>
</html>