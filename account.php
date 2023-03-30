<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="css/account.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();
        
        echo "<div class='container'>";

        if (isset($_SESSION["Customer"]))
        {
            $customer = $_SESSION["Customer"];
            echo "<h2>".$customer->FirstName. " " .$customer->Surname. " - " .$customer->Email."</h2>";

            $orders = getOrdersFromEmail($customer->Email);

            if (!empty($orders))
            {
                echo "<h3>Order History: </h3>";

                foreach ($orders as $order)
                {
                    $date = new DateTime($order->Date);
                    $date = $date->format('d-m-Y');

                    echo "<a href='view_order.php?id=$order->OrderID'>";
                    echo "<h4>$date - £$order->Total</h4>";
                    echo "</a>";
                }
            }

            $html = "
            <a href='update_details.php'>
                <button class='update-details'>Update Details</button>
            </a><br>
            <a href='change_password.php'>
                <button class='change_password'>Change Password</button>
            </a><br>
            <a href='sign_out.php'>
                <button class='sign-out'>Sign Out</button>
            </a>";

            echo $html;

        }

        echo "</div>";
    ?>



</body>
</html>