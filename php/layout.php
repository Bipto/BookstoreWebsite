<?php
    
    function createHeader(){
        $html = 
        '<div class="topbar">
            <h1 id="title">Selby Bookstore</h1>
        </div>
        <div class="navbar">
            <nav>
                <a href="index.php"><h1>Home</h1></a>
            </nav>
            <nav>
                <a href="account.php"><h1>Account</h1></a>
            </nav>
            <nav>
                <a href="cart.php"><h1>Cart</h1></a>
            </nav>
            <nav>
                <a href="about.php"><h1>About</h1></a>
            </nav>
        </div>';
        echo $html;
    }
?>