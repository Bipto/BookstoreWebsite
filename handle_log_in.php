<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>
    <link rel="stylesheet" href="css/handle_log_in.css">
</head>
<body>

    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();

        echo "<h2 class='content'>";

        $email = $_POST["email"];
        $password = $_POST["password"];

        $conn = openConnection();

        $sql = 'SELECT * FROM Bookstore.Customers WHERE Email = ?';
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();
        
        $result = $query->get_result();
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["Password"];

            if (password_verify($password, $hashedPassword))
            {
                $customer = new Customer();
                $customer->Email = $row["Email"];
                $customer->FirstName = $row["FirstName"];
                $customer->Surname = $row["Surname"];
                $customer->DateOfBirth = $row["DateOfBirth"];
                $customer->HouseNumber = $row["HouseNumber"];
                $customer->Street = $row["Street"];
                $customer->Town = $row["Town"];
                $customer->County = $row["County"];
                $customer->Country = $row["Country"];
                $customer->PostCode = $row["PostCode"];

                $_SESSION["Customer"] = $customer;


                header('Location: account.php');
                exit();
            }
            else
            {
                echo "Login failed: Invalid email or password";
            }
        }
        else
        {
            echo "Login failed: Invalid email or password";
        }

        $conn->close();

        echo "</h2>";
    ?>

</body>
</html>