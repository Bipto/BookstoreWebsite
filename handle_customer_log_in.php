<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>
    <link rel="stylesheet" href="css/handle_customer_log_in.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>

    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createNavigation();

        echo "<div class='content'>";

        $email = $_POST["email"];
        $password = $_POST["password"];

        $customer = getCustomerFromDetails($email, $password);
        if (!is_null($customer))
        {
            $_SESSION["Customer"] = $customer;
            header('Location: account.php');
        }
        else
        {
            $errorHtml = "
                <h2>Login failed: Invalid email or password!</h2>
                <form action='sign_in.php' method='get' class='form'>
                    <button type='submit'>Try again</button>
                </form>
            ";
            echo $errorHtml;
        }

        echo "</div>";
    ?>

</body>
</html>