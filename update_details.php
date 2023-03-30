<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <link rel="stylesheet" href="css/update_details.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php

        require_once "php/layout.php";
        require_once "php/database/database_connections.php";

        createHeader();

        if (isset($_SESSION["Customer"]))
        {
            $customer = $_SESSION["Customer"];

            echo "<h2>Update Details</h2>";
        
            $html = 
            '
            <div class="content">
            <form action="update_customer_in_database.php" method="post" class="form">
               
                <label for="title" class="label">Title:</label><br>
                <select name="title" id="title" class="entry">
                    <option value="Mr">Mr</option>
                    <option value="Miss">Miss</option>
                    <option value="Mrs">Mrs</option>
                </select>
                <br><br>

                <label for="fname" class="label">First Name:</label><br>
                <input type="text" id="fname" name="fname" class="entry" value='.$customer->FirstName.'>
                <br><br>

                <label for="sname" class="label">Surname:</label><br>
                <input type="text" id="sname" name="sname" class="entry" value='.$customer->Surname.'>
                <br><br>

                <label for="dob" class="label">Data of Birth:</label><br>
                <input type="date" id="dob" name="dob" class="entry" value='.$customer->DateOfBirth.'>
                <br><br>

                <label for="houseNum" class="label">House Number:</label><br>
                <input type="text" id="houseNum" name="houseNum" class="entry" value='.$customer->HouseNumber.'>
                <br><br>

                <label for="street" class="label">Street:</label><br>
                <input type="text" id="street" name="street" class="entry" value='.$customer->Street.'>
                <br><br>

                <label for="town" class="label">Town:</label><br>
                <input type="text" id="town" name="town" class="entry" value='.$customer->Town.'>
                <br><br>

                <label for="county" class="label">County:</label><br>
                <input type="text" id="county" name="county" class="entry" value='.$customer->County.'>
                <br><br>

                <label for="country" class="label">Country:</label><br>
                <input type="text" id="country" name="country" class="entry" value='.$customer->Country.'>
                <br><br>

                <label for="postCode" class="label">Post Code:</label><br>
                <input type="text" id="postCode" name="postCode" class="entry" value='.$customer->PostCode.'>
                <br><br>

                <input type="submit" value="Submit" class="submitButton">
                <br><br>
            </form>
            </div>';
            echo $html;
        }

    ?>


</body>
</html>