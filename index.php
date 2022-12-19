<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
    <?php
        require_once "php/layout.php";
        require_once "php/book.php";

        function createBookGrid($books){
            foreach ($books as $book){
                $html = "
                    <div class='book'>
                        <img src=" .$book->ImagePath. " class='grid-item'>
                        <h1 class='book-title'>" .$book->Title. "</h1>
                    </div>
                    ";

                echo $html;
            }
        }

        function createSearchbar(){
            $html = "
                <form>
                Name: <input type='text' id='searchtext'>
                <input type='submit' value='Submit' onclick='myFunction()'>
                </form>";
            echo $html;
        }

        createHeader();  
        createSearchbar();

        $book1 = new Book();
        $book1->BookID = 0;
        $book1->Title = "The Hobbit";
        $book1->Author = "J.R.R Tolkien";
        $book1->Genre = "Fantasy";
        $book1->Price = 7.99;
        $book1->ImagePath = "img/the_hobbit.jpg";

        $book2 = new Book();
        $book2->BookID = 0;
        $book2->Title = "The Fellowship of the Ring";
        $book2->Author = "J.R.R Tolkien";
        $book2->Genre = "Fantasy";
        $book2->Price = 7.99;
        $book2->ImagePath = "img/fellowship_of_the_ring.png";

        $book3 = new Book();
        $book3->BookID = 0;
        $book3->Title = "The Two Towers";
        $book3->Author = "J.R.R Tolkien";
        $book3->Genre = "Fantasy";
        $book3->Price = 7.99;
        $book3->ImagePath = "img/the_two_towers.png";

        $book4 = new Book();
        $book4->BookID = 0;
        $book4->Title = "The Return of the King";
        $book4->Author = "J.R.R Tolkien";
        $book4->Genre = "Fantasy";
        $book4->Price = 7.99;
        $book4->ImagePath = "img/the_return_of_the_king.png";

        $book5 = new Book();
        $book5->BookID = 0;
        $book5->Title = "The Silmarillion";
        $book5->Author = "J.R.R Tolkien";
        $book5->Genre = "Fantasy";
        $book5->Price = 7.99;
        $book5->ImagePath = "img/the_silmarillion.png";

        $book6 = new Book();
        $book6->BookID = 0;
        $book6->Title = "Unfinished Tales of Numenor and Middle-Earth";
        $book6->Author = "J.R.R Tolkien";
        $book6->Genre = "Fantasy";
        $book6->Price = 7.99;
        $book6->ImagePath = "img/unfinished_tales_of_numenor_middle_earth.jpg";

        $book7 = new Book();
        $book7->BookID = 0;
        $book7->Title = "The Fall of Numenor";
        $book7->Author = "J.R.R Tolkien";
        $book7->Genre = "Fantasy";
        $book7->Price = 7.99;
        $book7->ImagePath = "img/fall_of_numenor.jpg";

        $book8 = new Book();
        $book8->BookID = 0;
        $book8->Title = "Harry Potter and the Philosopher's Stone";
        $book8->Author = "J.K. Rowling";
        $book8->Genre = "Fantasy";
        $book8->Price = 7.99;
        $book8->ImagePath = "img/harry_potter_philosophers_stone.png";

        $book9 = new Book();
        $book9->BookID = 0;
        $book9->Title = "Harry Potter and the Chamber of Secrets";
        $book9->Author = "J.K. Rowling";
        $book9->Genre = "Fantasy";
        $book9->Price = 7.99;
        $book9->ImagePath = "img/harry_potter_chamber_of_secrets.png";

        $book10 = new Book();
        $book10->BookID = 0;
        $book10->Title = "Harry Potter and the Prisoner of Azkaban";
        $book10->Author = "J.K. Rowling";
        $book10->Genre = "Fantasy";
        $book10->Price = 7.99;
        $book10->ImagePath = "img/harry_potter_prisoner_of_azkaban.png";

        $book11 = new Book();
        $book11->BookID = 0;
        $book11->Title = "Harry Potter and the Goblet of Fire";
        $book11->Author = "J.K. Rowling";
        $book11->Genre = "Fantasy";
        $book11->Price = 7.99;
        $book11->ImagePath = "img/harry_potter_goblet_of_fire.png";

        $book12 = new Book();
        $book12->BookID = 0;
        $book12->Title = "Harry Potter and the Order of the Phoenix";
        $book12->Author = "J.K. Rowling";
        $book12->Genre = "Fantasy";
        $book12->Price = 7.99;
        $book12->ImagePath = "img/harry_potter_order_of_the_phoenix.png";

        $book13 = new Book();
        $book13->BookID = 0;
        $book13->Title = "Harry Potter and the Half Blood Prince";
        $book13->Author = "J.K. Rowling";
        $book13->Genre = "Fantasy";
        $book13->Price = 7.99;
        $book13->ImagePath = "img/harry_potter_order_of_the_phoenix.png";

        $book14 = new Book();
        $book14->BookID = 0;
        $book14->Title = "Harry Potter and the Deathly Hallows";
        $book14->Author = "J.K. Rowling";
        $book14->Genre = "Fantasy";
        $book14->Price = 7.99;
        $book14->ImagePath = "img/harry_potter_and_the_deathly_hallows.jpg";

        $book15 = new Book();
        $book15->BookID = 0;
        $book15->Title = "The Hunger Games";
        $book15->Author = "Suzanne Collins";
        $book15->Genre = "Fantasy";
        $book15->Price = 7.99;
        $book15->ImagePath = "img/the_hunger_games.jpg";

        $book16 = new Book();
        $book16->BookID = 0;
        $book16->Title = "The Hunger Games: Catching Fire";
        $book16->Author = "Suzanne Collins";
        $book16->Genre = "Fantasy";
        $book16->Price = 7.99;
        $book16->ImagePath = "img/the_hunger_games_catching_fire.jpg";

        $book17 = new Book();
        $book17->BookID = 0;
        $book17->Title = "The Hunger Games: Mockingjay";
        $book17->Author = "Suzanne Collins";
        $book17->Genre = "Fantasy";
        $book17->Price = 7.99;
        $book17->ImagePath = "img/the_hunger_games_mockingjay.jpg";

        $book18 = new Book();
        $book18->BookID = 0;
        $book18->Title = "The Ballad of Songbirds and Snakes";
        $book18->Author = "Suzanne Collins";
        $book18->Genre = "Fantasy";
        $book18->Price = 7.99;
        $book18->ImagePath = "img/ballad_of_songbirds_and_snakes.jpg";

        $books = array();
        array_push($books, $book1);
        array_push($books, $book2);
        array_push($books, $book3);
        array_push($books, $book4);
        array_push($books, $book5);
        array_push($books, $book6);
        array_push($books, $book7);
        array_push($books, $book8);
        array_push($books, $book9);
        array_push($books, $book10);
        array_push($books, $book11);
        array_push($books, $book12);
        array_push($books, $book13);
        array_push($books, $book14);
        array_push($books, $book15);
        array_push($books, $book16);
        array_push($books, $book17);
        array_push($books, $book18);

        echo "<div id='grid'>";
        createBookGrid($books);
        echo "</div>";
    ?>   

</body>
</html>