<?php
    
    require_once "php/database/database_connections.php";
    
    session_start();
    $cartID = $_REQUEST["id"];

    $book = getBookByCartID($cartID);
    increaseStockCount($book);

    removeBookFromCart($cartID);
    header('Location: cart.php');
?>