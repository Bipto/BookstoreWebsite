<?php

    function createRemoveBookScreen()
    {
        require_once "php/database/database_connections.php";

        $id = $_GET["id"];

        echo "<h2>Remove Book</h2>";

        removeBook($id);
    }

?>