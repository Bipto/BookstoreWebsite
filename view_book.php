<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
    <link rel="stylesheet" href="css/view_book.css">
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/display_books.php";

        $books = createBooks();
        createHeader();

        $id = $_GET["id"];
        $selectedBook = $books[$id];

        $html = "
        <div class='book'>
            <img src=" .$selectedBook->ImagePath. " class='book-image' >
            <h2>" .$selectedBook->Title. " - " .$selectedBook->Author.  "</h2>
            <h3>" .$selectedBook->Genre. "</h3>
            <h3> £" .$selectedBook->Price. "</h3>
            <div> Description: " .$selectedBook->Description. "</div>
        </div>
        ";

        echo $html;

    ?>

</body>
</html>