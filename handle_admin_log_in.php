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
        require_once "php/database/administrator.php";

        createHeader();

        echo "<h2 class='content'>";

        $email = $_POST["email"];
        $password = $_POST["password"];

        $conn = openConnection();

        $sql = 'SELECT * FROM Bookstore.Administrators WHERE Email = ?';
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
                $admin = new Admin();
                $admin->Email = $row["Email"];
                $admin->FirstName = $row["FirstName"];
                $admin->Surname = $row["Surname"];
                $admin->DateOfBirth = $row["DateOfBirth"];
                $admin->HouseNumber = $row["HouseNumber"];
                $admin->Street = $row["Street"];
                $admin->Town = $row["Town"];
                $admin->County = $row["County"];
                $admin->Country = $row["Country"];
                $admin->PostCode = $row["PostCode"];

                $_SESSION["Admin"] = $admin;

                header('Location: admin_dashboard.php');
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