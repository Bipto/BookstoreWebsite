<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selby Bookstore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/database/database_connections.php";
        require_once "php/database/book.php";
    
        function createSearchbar($text)
        {
            $html = "
                <div class='searchbar'>
                    <form>
                        <input type='text' id='searchtext' value='$text'>
                        <input type='submit' id='searchButton' value='Search' onClick='searchBooksHome()'>
                    </form>
                </div>";
            echo $html;
        }
        
        function createBookGrid($books, $searchText)
        {
            foreach ($books as $book)
            {
                $title = strtolower($book->Title);
                $searchText = strtolower($searchText);
    
                if (str_contains($title, $searchText))
                {
                    $html = "
                    <a href='view_book.php?id=" .$book->BookID."'>
                        <div class='book'>
                            <img src=" .$book->ImagePath. " class='book-image' loading='lazy'>
                            <h1 class='book-title'>" .$book->Title. "</h1>
                            <span class='tooltiptext'>$book->Title</span>
                        </div>
                    </a>
                    ";
    
                    echo $html;
                }
            }
        }

        $searchText = "";
        if (!empty($_REQUEST["name"]))
        {
            $searchText = $_REQUEST["name"];
        }

        createHeader();  
        createSearchbar($searchText);            

        $books = getBooks();

        echo "<div id='grid'>";
        createBookGrid($books, $searchText);
        echo "</div>";
    ?>   

</body>
</html>