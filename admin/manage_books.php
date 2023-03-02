<?php

    function createManageBooksScreen()
    {
        require_once "php/database/database_connections.php";

        echo "<h2>Manage Books</h2>";
        
        $books = getBooks();

        echo "<div id='grid'>";

        foreach ($books as $book)
        {
            /* $url = "admin_dashboard.php?action=edit&id=$book->BookID";
            echo "<a href='$url' class='bookInfo'>";
            $bookInfo = "$book->Title - $book->Author<br>";
            echo "$bookInfo";
            echo "</a>"; */

            $url = "admin_dashboard.php?action=edit&id=$book->BookID";

            $html = "
            <a href='$url' class='bookInfo'>
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