<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/display_books.php";
        require_once "php/book.php";
    
        function createSearchbar(){
            $html = "
                <div class='searchbar'>
                    <form class=>
                        <input type='text' id='searchtext'>
                        <input type='submit' id='submitButton' value='Search' onClick='searchBooks()'>
                    </form>
                </div>";
            echo $html;
        }

        createHeader();  
        createSearchbar();
        
        $searchText = "";
        if (!empty($_REQUEST["name"]))
        {
            $searchText = $_REQUEST["name"];
        }
     
        $books = createBooks("");

        echo "<div id='grid'>";
        createBookGrid($books, $searchText);
        echo "</div>";
    ?>   

</body>
</html>