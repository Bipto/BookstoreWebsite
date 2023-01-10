<?php

class Customer{
    public $CustomerID;
    public $FirstName;
    public $Surname;
}

function login()
{
    $customer = new Customer();
    $customer->CustomerID = 0;
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