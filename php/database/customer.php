<?php

class Customer{
    public $Email;
    public $Title;
    public $FirstName;
    public $Surname;
    public $DateOfBirth;
    public $HouseNumber;
    public $Street;
    public $Town;
    public $County;
    public $Country;
    public $PostCode;
    public $Password;
}

function login()
{
    $customer = new Customer();
    $customer->FirstName = "Adam";
    $customer->Surname = "Beardow";

    $_SESSION["Customer"] = $customer;
}

function printID()
{
    if (isset($_SESSION["Customer"]))
    {
        $account = $_SESSION["Customer"];
        echo $account->FirstName;
    } 
}

?>