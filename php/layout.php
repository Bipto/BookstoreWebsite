<?php
    
    function createNavigation(){

        require_once "database/customer.php";

        session_start();

        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
        echo '<script defer type="text/javascript" src="js/main.js"></script>';
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">';

        echo "
        <span id='mouse-circle' class='circle'></span>
        ";

        $html = '
        <div class="dropdown">
            <div class="topbar">
                <img src="img/logo.png" class="logo">
                <h1 id="title">Selby Bookstore</h1>
                <a href="javascript:void(0);" class="icon" onclick="toggleDropdownMenu()()">
                    <i class="fa fa-bars" id="hamburger">
                </i>
                </a>
            </div>
        </div>';
        echo $html;

        echo '
            <div class="navbar" id="navbar">
            <nav>
                <a href="index.php"><h1>Home</h1></a>
            </nav>';

        //if customer is not logged in re-direct cart page to sign-in page
        if (!isset($_SESSION["Customer"]))
        {
            echo '
                <nav>
                    <a href="sign_in.php"><h1>Cart</h1></a>
                </nav>';
        }
        else
        {
            echo '
                <nav>
                    <a href="cart.php"><h1>Cart</h1></a>
                </nav>';
        }

        echo '
                <nav>
                    <a href="about.php"><h1>About</h1></a>
                </nav>';

        //if customer is not logged in, direct to sign-in page
        //otherwise direct to account page
        if (!isset($_SESSION["Customer"]))
        {
            echo '<nav>
                    <a href="sign_in.php"><h1>Sign In</h1></a>
                    </nav>';
        }
        else
        {
            echo '<nav>
                    <a href="account.php"><h1>Account</h1></a>
                    </nav>';
        }

        echo '</div>';
    }
?>