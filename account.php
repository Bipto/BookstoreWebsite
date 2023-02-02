<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="css/account.css">
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
            echo "<h2>" .$customer->Email. "</h2>";

            $orders = getOrdersFromEmail($customer->Email);

            if (!empty($orders))
            {
                echo "<h3>Order History: </h3>";

                foreach ($orders as $order)
                {
                    echo "$order<br>";
                }
            }

            $html = "
            <a href='sign_out.php'>
                <button class='sign-out'>Sign Out</button>
            </a>";

            echo $html;

        }

        echo "</div>";
    ?>



</body>
</html>