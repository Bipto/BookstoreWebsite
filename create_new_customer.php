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

        createHeader();

        if (!isset($_GET["details_valid"]))
        {
            $email = $_POST["email"];
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
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];

            if ($password === $confirmPassword)
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $conn = openConnection();

                $sql = 
                "
                INSERT INTO Bookstore.Customers(Email, Title, FirstName, Surname, DateOfBirth, HouseNumber, Street, Town, County, Country, PostCode, Password)
                VALUES ('$email', '$title', '$fname', '$sname', '$dob', '$houseNum', '$street', '$town', '$county', '$country', '$postCode', '$hashedPassword')
                ";

                $customer = new Customer();
                $customer->Email = $email;
                $customer->FirstName = $fname;
                $customer->Surname = $sname;
                $customer->DateOfBirth = $dob;
                $customer->HouseNumber = $houseNum;
                $customer->Street = $street;
                $customer->Town = $town;
                $customer->County = $county;
                $customer->Country = $country;
                $customer->PostCode = $postCode;
                $customer->Password = $hashedPassword;

                $_SESSION["Customer"] = $customer;
                
                $conn->close();

                header('Location: create_new_customer.php?details_valid=true');
            }
            else
            {
                echo "<h2 class='content'>";
                echo "Passwords do not match!";
                echo "</h2>";
            }
        }

        else
        {                   
            echo "<h2 class='content'>";
            echo "Account created successfully";    
            echo "</h2>";
        }        

    ?>
</body>
</html>