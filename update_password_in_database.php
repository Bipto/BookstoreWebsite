<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password updated successfully</title>
    <link rel="stylesheet" href="css/update_password_in_database.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();

        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        echo "<div class='container'>";
        if ($password === $confirmPassword)
        {
            if (isset($_SESSION["Customer"]))
            {
                $customer = $_SESSION["Customer"];

                if (updateCustomerPassword($customer, $password))
                    echo "<h2>Password updated successfully.</h2>";
                else
                    echo "<h2>Password could not be updated.</h2>";
            }
        }
        else
        {
            $html = 
            "
                <h2>Passwords do not match!</h2>
                <form action='change_password.php' method='get' class='form'>
                    <button type='submit'>Try again</button>
                </form>
            ";
            echo $html;
        }
        echo "</div>";

    ?>
</body>
</html>