<?php
    
    require_once "php/database/database_connections.php";
    
    session_start();
    $cartID = $_REQUEST["id"];
    removeBookFromCart($cartID);
    header('Location: cart.php');
?>