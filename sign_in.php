<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="css/sign_in.css">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/customer.php";

        createHeader();
    ?>

    <div class='title'>
        <h1>Sign In</h1>
    </div>

    <form class="login" action="handle_log_in.php" method="post">
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
</body>
</html>