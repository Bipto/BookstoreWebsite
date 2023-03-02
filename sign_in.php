<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="css/sign_in.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/database/customer.php";

        createHeader();
    ?>

    <div class='title'>
        <h1>Sign In</h1>
    </div>

    <form class="login" action="handle_customer_log_in.php" method="post">
        <label for="email" id="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password" id="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" id="submitButton" value="Sign In">
    </form>

    <a href="new_customer.php">
        <p id="createAccount">
            Create a new account?
        </p>
    </a>

    <a href="admin_sign_in.php">
        <p id="adminSignIn">
            Sign in (Adminstrator)
        </p>
    </a>

</body>
</html>