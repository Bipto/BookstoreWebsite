<?php

    function createSearchbar($text)
    {
        $html = "
                <div class='searchbar'>
                    <form>
                        <input type='text' id='searchtext' value=''>
                        <input type='submit' id='searchButton' value='Search' onClick='searchBooksAdmin()'>
                    </form>
                </div>";
        echo $html;
    }

    function createManageBooksScreen($searchText)
    {
        require_once "php/database/database_connections.php";

        echo "<h2 class='title'>Manage Books</h2>";        
        $books = getBooks();
        createSearchbar("");

        echo "<div id='grid'>";

        foreach ($books as $book)
        {
            $title = strtolower($book->Title);
            $searchText = strtolower($searchText);

            if (str_contains($title, $searchText))
            {
                $url = "admin_dashboard.php?action=edit&id=$book->BookID";

                $html = "
                <a href='$url' id='bookInfo'>
                    <div class='book'> 
                        <img src='$book->ImagePath' class='book-image'>
                        <h1 class='book-title'>$book->Title</h1>
                        <span class='tooltiptext'>$book->Title</span>
                    </div>
                </a>
                ";

                echo $html;
            }            
        }

        echo "</div>";
    }

?>