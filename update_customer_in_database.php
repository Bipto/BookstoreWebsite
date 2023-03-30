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

        $firstName = $_POST["fname"];
        $title = $_POST["title"];
        $fname = $_POST["fname"];
        $sname = $_POST["sname"];
        $dob = $_POST["dob"];
        $houseNum = $_POST["houseNum"];
        $street = $_POST["street"];
        $town = $_POST["town"];
        $county = $_POST["county"];
        $country = $_POST["country"];
        $postCode = $_POST["postCode"];

        $conn = openConnection();
        $customer = $_SESSION["Customer"];
        $customer->Title = $title;
        $customer->FirstName = $fname;
        $customer->Surname = $sname;
        $customer->DateOfBirth = $dob;
        $customer->HouseNumber = $houseNum;
        $customer->Street = $street;
        $customer->Town = $town;
        $customer->County = $county;
        $customer->Country = $country;
        $customer->PostCode = $postCode;

        if (updateCustomerDetails($customer))
        {
            $_SESSION["Customer"] = $customer;
            echo "<h2>Customer details updated successfully.</h2>";
        }

    ?>
</body>
</html>