<?php

    function createAddBookScreen()
    {
        $html = 
        "
        <form action='admin_dashboard.php?action=inserted' method='post' class='form'>
            <h2>Add Book</h2>
        
            <label for='title' type='text' class='label'>Title:</label><br>
            <input type='text' id='title' name='title' class='entry'><br>

            <label for='author' type='text' class='label'>Author:</label><br>
            <input type='text' id='author' name='author' class='entry'><br>

            <label for='description' type='text' class='label'>Description:</label><br>
            <input type='text' id='description' name='description' class='entry'><br>

            <label for='genre' type='text' class='label'>Genre:</label><br>
            <input type='text' id='genre' name='genre' class='entry'><br>

            <label for='price' type='text' class='label'>Price:</label><br>
            <input type='number' min='0.1' step='any' name='price' class='entry'/><br>

            <label for='path' type='text' class='path'>Image Path:</label><br>
            <input type='text' id='path' name='path' class='entry'><br><br>

            <input type='submit' value='Add' class='submitButton'>
            <br><br>
        </form>
        ";

        echo $html;
    }

?>