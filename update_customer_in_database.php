<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer updated successfully</title>
    <link rel="stylesheet" href="css/update_customer_in_database.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();

        $customer = $_SESSION["Customer"];
        $customer->Title = $_POST["title"];
        $customer->FirstName = $_POST["fname"];
        $customer->Surname = $_POST["sname"];
        $customer->DateOfBirth = $_POST["dob"];
        $customer->HouseNumber = $_POST["houseNum"];
        $customer->Street = $_POST["street"];
        $customer->Town = $_POST["town"];
        $customer->County = $_POST["county"];
        $customer->Country = $_POST["country"];
        $customer->PostCode = $_POST["postCode"];

        if (updateCustomerDetails($customer))
        {
            $_SESSION["Customer"] = $customer;
            $html = "
                <div class='container'>
                    <h2>Customer details updated successfully.</h2>
                </div>
            ";
            echo $html;        
        }

    ?>
</body>
</html>