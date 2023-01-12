<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signed Out</title>
    <link rel="stylesheet" href="css/sign_out.css">
</head>
<body>
    <?php


        require_once "php/layout.php";
        createHeader();

        header('Location: index.php');
        session_unset();
        exit();
    ?>



</body>
</html>