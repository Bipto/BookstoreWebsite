<?php
    
    function createHeader(){
        $html = '<div class="topbar">
        <h1 class="title">Selby Bookstore</h1>
        </div>
        <div class="navbar">
            <nav>
                <h2>Home</h2>
            </nav>
            <nav>
                <h2>Account</h2>
            </nav>
            <nav>
                <h2>Cart</h2>
            </nav>
            <nav>
                <h2>About</h2>
            </nav>
        </div>';
        echo $html;
    }

?>