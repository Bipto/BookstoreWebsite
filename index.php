<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
    <?php
        require_once "php/layout.php";
        createHeader();
    ?>   

    <div class="grid">
        <!-- <button type="button" onclick="myFunction()">Click me</button>
        <button type="button" onclick="myFunction()">Click me</button>
        <div class="myDiv">Hello</div> -->

        <img src="img/fellowship_of_the_ring.png" class="grid-item">
        <img src="img/the_return_of_the_king.png" class="grid-item">
        <img src="img/the_two_towers.png" class="grid-item">
        <img src="img/the_silmarillion.png" class="grid-item">

        <img src="img/harry_potter_philosophers_stone.png" class="grid-item">
        <img src="img/harry_potter_chamber_of_secrets.png" class="grid-item">
        <img src="img/harry_potter_prisoner_of_azkaban.png" class="grid-item">
        <img src="img/harry_potter_goblet_of_fire.png" class="grid-item">
        <img src="img/harry_potter_order_of_the_phoenix.png" class="grid-item">

        <div class="footer"></div>
    </div>

</body>
</html>