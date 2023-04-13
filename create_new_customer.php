<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer created successfully</title>
    <link rel="stylesheet" href="css/create_new_customer.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createNavigation();
        echo "<h2 class='content'>";

        if (!isset($_GET["details_valid"]))
        {
            $customer = new Customer();
            $customer->Email = $_POST["email"];
            $customer->Title = $_POST["title"];
            $customer->FirstName = $_POST["fname"];
            $customer->Surname = $_POST["sname"];
            $customer->DateOfBirth = $_POST["dob"];
            $customer->HouseNumber = $_POST["houseNum"];
            $customer->Street = $_POST["street"];
            $customer->Town = $_POST["town"];
            $customer->County = $_POST["county"];
            $customer->Country = $_POST["country"];
            $customer->PostCode =  $_POST["postCode"];

            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];

            if ($password === $confirmPassword)
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $customer->Password = $hashedPassword;

                $_SESSION["Customer"] = $customer;
                
                $text = insertCustomer($customer);
                if ($text === "Customer created successfully")
                    header('Location: account.php');
            }
            else
                echo "Passwords do not match!";
        }
        echo "</h2>";

    ?>
</body>
</html>