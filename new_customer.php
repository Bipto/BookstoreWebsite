<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer</title>
    <link rel="stylesheet" href="css/new_customer.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        createNavigation();
    ?>

    <div class="title">
        <h1>New Customer</h1>
    </div>

    <form action="create_new_customer.php" method="post" class="form">
        <label for="email" type="email" class="label">Email:</label><br>
        <input type="text" id="email" name="email" class="entry">
        <br><br>
        
        <label for="title" class="label">Title:</label><br>
        <select name="title" id="title" class="entry">
            <option value="Mr">Mr</option>
            <option value="Miss">Miss</option>
            <option value="Mrs">Mrs</option>
        </select>
        <br><br>

        <label for="fname" class="label">First Name:</label><br>
        <input type="text" id="fname" name="fname" class="entry">
        <br><br>

        <label for="sname" class="label">Surname:</label><br>
        <input type="text" id="sname" name="sname" class="entry">
        <br><br>

        <label for="dob" class="label">Data of Birth:</label><br>
        <input type="date" id="dob" name="dob" class="entry">
        <br><br>

        <label for="houseNum" class="label">House Number:</label><br>
        <input type="text" id="houseNum" name="houseNum" class="entry">
        <br><br>

        <label for="street" class="label">Street:</label><br>
        <input type="text" id="street" name="street" class="entry">
        <br><br>

        <label for="town" class="label">Town:</label><br>
        <input type="text" id="town" name="town" class="entry">
        <br><br>

        <label for="county" class="label">County:</label><br>
        <input type="text" id="county" name="county" class="entry">
        <br><br>

        <label for="country" class="label">Country:</label><br>
        <input type="text" id="country" name="country" class="entry">
        <br><br>

        <label for="postCode" class="label">Post Code:</label><br>
        <input type="text" id="postCode" name="postCode" class="entry">
        <br><br>

        <label for="password" class="label">Password:</label><br>
        <input type="password" id="password" name="password" class="entry">
        <br><br>

        <label for="confirmPasssword" class="label">Confirm Password:</label><br>
        <input type="password" id="confirmPassword" name="confirmPassword" class="entry">
        <br><br>

        <input type="submit" value="Submit" class="submitButton">
        <br><br>
    </form>

</body>
</html>