<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    <?php
        require_once "php/layout.php";
        createHeader();

        if (isset($_SESSION["Customer"]))
        {
            $customer = $_SESSION["Customer"];
            echo "<div class='content'><h4>" .$customer->Email. "</h4></div>";
        }

        $html = "
            <a href='sign_out.php' class='content'>
                <button class='content'>Sign Out</button>
            </a>";

        echo $html;
    ?>



</body>
</html>