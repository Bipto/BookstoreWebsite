<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>
    <link rel="stylesheet" href="css/handle_admin_log_in.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>

    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";
        require_once "php/database/administrator.php";

        createHeader();

        echo "<div class='content'>";

        $email = $_POST["email"];
        $password = $_POST["password"];

        $admin = getAdminFromDetails($email, $password);
        if (!is_null($admin))
        {
            $_SESSION["Admin"] = $admin;
            header('Location: admin_dashboard.php?action=manage');
        }
        else
        {
            $errorHtml = "
                <h2>Login failed: Invalid email or password!</h2>
                <form action='admin_sign_in.php' method='get' class='form'>
                    <button type='submit'>Try again</button>
                </form>
            ";
            echo $errorHtml;
        }

        echo "</div>";
    ?>

</body>
</html>