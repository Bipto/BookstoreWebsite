<?php

require_once "cart.php";
require_once "php/database/database_connections.php";

session_start();

$customer = $_SESSION["Customer"];

if (isset($_GET["id"]))
{
    $bookId = $_GET["id"];
    addBookToCart($customer->Email, $bookId);
}

header('Location: cart.php');

?>