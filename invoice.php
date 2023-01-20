<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/invoice.css">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();
    ?>

    <div class="title">
        <h1>Invoice</h1>
    </div>

    <form action="payment.php" method="post" class="form">
        <label for="email" id="email" name="email" class="entry">Email:<br>
        <input type="text" id="email" name="email" class="entry">
        <br><br>

        <h3>Shipping Information</h3>
        <label for="houseNum" id="houseNum" name="houseNum" class="entry">House Number:<br>
        <input type="text" id="houseNum" name="email" class="entry">
        <br><br>

        <label for="street" id="street" name="street" class="entry">Street:<br>
        <input type="text" id="street" name="street" class="entry">
        <br><br>

        <label for="town" id="town" name="town" class="entry">Town:<br>
        <input type="text" id="town" name="town" class="entry">
        <br><br>

        <label for="county" id="county" name="county" class="entry">Town:<br>
        <input type="text" id="county" name="county" class="entry">
        <br><br>

        <label for="country" id="country" name="country" class="entry">Town:<br>
        <input type="text" id="country" name="country" class="entry">
        <br><br>

        <label for="postCode" id="postCode" name="postCode" class="entry">Town:<br>
        <input type="text" id="postCode" name="postCode" class="entry">
        <br><br>

        <input type="submit" value="Submit" class="submitButton">
        <br><br>       
        
    </form>

    </form>
</body>
</html>