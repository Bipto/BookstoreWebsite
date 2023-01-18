<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Book</title>
</head>
<body>
    <h1>New Book</h1>
    <form action="../php/database/insert_new_book.php" method="post">
        <label for="title">Title:</label>
        <br><br>
        <input type="text" id="title" name="title">
        <br><br>

        <label for="author">Author:</label>
        <br><br>
        <input type="text" id="author" name="author">
        <br><br>

        <label for="genre">Genre:</label>
        <br><br>
        <input type="text" id="genre" name="genre">
        <br><br>

        <label for="description">Description:</label>
        <br><br>
        <textarea name="description" cols="40" rows="5"></textarea>
        <br><br>

        <label for="price">Price:</label>
        <br><br>
        <input type="number" id="price" name="price" step="0.01" min="0.00" max="1000.00" value="1.0">
        <br><br>

        <label for="imagePath">Image Path:</label>
        <br><br>
        <input type="text" id="imagePath" name="imagePath"></input>
        <br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>