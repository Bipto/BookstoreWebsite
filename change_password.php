<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/change_password.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once  "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();

        echo "<h2>Update Details</h2>";

        $html = 
        '
        <form action="update_password_in_database.php" method="post" class="form">
            <label for="password" class="label">Password:</label><br>
            <input type="password" id="password" name="password" class="entry">
            <br><br>

            <label for="confirmPassword" class="label">Confirm Password:</label><br>
            <input type="password" id="confirmPassword" name="confirmPassword" class="entry">
            <br><br>

            <input type="submit" value="Submit" class="submitButton">
        </form>
        ';
        echo $html;
    ?>
</body>
</html>