<?php

    function createManageBooksScreen()
    {
        require_once "php/database/database_connections.php";

        echo "<h2 class='title'>Manage Books</h2>";        
        $books = getBooks();

        echo "<div id='grid'>";

        foreach ($books as $book)
        {
            $url = "admin_dashboard.php?action=edit&id=$book->BookID";

            $html = "
            <a href='$url' id='bookInfo' class='hidden'>
                <div class='book'> 
                    <img src='$book->ImagePath' class='book-image'>
                    <h1 class='book-title'>$book->Title</h1>
                </div>
            </a>
            ";

            echo $html;
        }

        echo "</div>";
    }

?>