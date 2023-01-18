<?php
    require_once "database/book.php";

    function createBookGrid($books, $searchText){
        foreach ($books as $book){

            $title = strtolower($book->Title);
            $searchText = strtolower($searchText);

            if (str_contains($title, $searchText))
            {
                $html = "
                <a href='view_book.php?id=" .$book->BookID."'>
                    <div class='book'>
                        <img src=" .$book->ImagePath. " class='book-image'>
                        <h1 class='book-title'>" .$book->Title. "</h1>
                    </div>
                </a>
                ";

                echo $html;
            }
        }
    }

    function createBooks()
    {
        $book1 = new Book();
        $book1->BookID = 0;
        $book1->Title = "The Hobbit";
        $book1->Author = "J.R.R Tolkien";
        $book1->Genre = "Fantasy";
        $book1->Price = 7.99;
        $book1->ImagePath = "img/the_hobbit.jpg";
        $book1->Description = "The Hobbit, or There and Back Again is a children's fantasy novel by English author J. R. R. Tolkien. It was published in 1937 to wide critical acclaim, being nominated for the Carnegie Medal and awarded a prize from the New York Herald Tribune for best juvenile fiction. The book remains popular and is recognized as a classic in children's literature.

        The Hobbit is set within Tolkien's fictional universe and follows the quest of home-loving Bilbo Baggins, the titular hobbit, to win a share of the treasure guarded by a dragon named Smaug. Bilbo's journey takes him from his light-hearted, rural surroundings into more sinister territory.
        
        The story is told in the form of an episodic quest, and most chapters introduce a specific creature or type of creature of Tolkien's geography. Bilbo gains a new level of maturity, competence, and wisdom by accepting the disreputable, romantic, fey, and adventurous sides of his nature and applying his wits and common sense. The story reaches its climax in the Battle of Five Armies, where many of the characters and creatures from earlier chapters re-emerge to engage in conflict.
        
        Personal growth and forms of heroism are central themes of the story, along with motifs of warfare. These themes have led critics to view Tolkien's own experiences during World War I as instrumental in shaping the story. The author's scholarly knowledge of Germanic philology and interest in mythology and fairy tales are often noted as influences.
        
        The publisher was encouraged by the book's critical and financial success and, therefore, requested a sequel. As Tolkien's work progressed on its successor, The Lord of the Rings, he made retrospective accommodations for it in The Hobbit. These few but significant changes were integrated into the second edition. Further editions followed with minor emendations, including those reflecting Tolkien's changing concept of the world into which Bilbo stumbled.
        
        The work has never been out of print. Its ongoing legacy encompasses many adaptations for stage, screen, radio, board games, and video games. Several of these adaptations have received critical recognition on their own merits. ";

        $book2 = new Book();
        $book2->BookID = 1;
        $book2->Title = "The Fellowship of the Ring";
        $book2->Author = "J.R.R Tolkien";
        $book2->Genre = "Fantasy";
        $book2->Price = 7.99;
        $book2->ImagePath = "img/fellowship_of_the_ring.png";

        $book3 = new Book();
        $book3->BookID = 2;
        $book3->Title = "The Two Towers";
        $book3->Author = "J.R.R Tolkien";
        $book3->Genre = "Fantasy";
        $book3->Price = 7.99;
        $book3->ImagePath = "img/the_two_towers.png";

        $book4 = new Book();
        $book4->BookID = 3;
        $book4->Title = "The Return of the King";
        $book4->Author = "J.R.R Tolkien";
        $book4->Genre = "Fantasy";
        $book4->Price = 7.99;
        $book4->ImagePath = "img/the_return_of_the_king.png";

        $book5 = new Book();
        $book5->BookID = 4;
        $book5->Title = "The Silmarillion";
        $book5->Author = "J.R.R Tolkien";
        $book5->Genre = "Fantasy";
        $book5->Price = 7.99;
        $book5->ImagePath = "img/the_silmarillion.png";
        $book5->Description = "The Silmarillion (Quenya: [silmaˈrilliɔn]) is a collection of myths[T 1] and stories in varying styles by the English writer J. R. R. Tolkien. It was edited and published posthumously by his son Christopher Tolkien in 1977, assisted by the fantasy author Guy Gavriel Kay.[T 2] It tells of Eä, a fictional universe that includes the Blessed Realm of Valinor, the once-great region of Beleriand, the sunken island of Númenor, and the continent of Middle-earth, where Tolkien's most popular works—The Hobbit and The Lord of the Rings—are set. After the success of The Hobbit, Tolkien's publisher Stanley Unwin requested a sequel, and Tolkien offered a draft of the writings that would later become The Silmarillion. Unwin rejected this proposal, calling the draft obscure and \"too Celtic\", so Tolkien began working on a new story that eventually became The Lord of the Rings.

        The Silmarillion has five parts. The first, Ainulindalë, tells in mythic style of the creation of Eä, the \"world that is.\" The second part, Valaquenta, gives a description of the Valar and Maiar, supernatural powers of Eä. The next section, Quenta Silmarillion, which forms the bulk of the collection, chronicles the history of the events before and during the First Age, including the wars over three jewels, the Silmarils, that gave the book its title. The fourth part, Akallabêth, relates the history of the Downfall of Númenor and its people, which takes place in the Second Age. The final part, Of the Rings of Power and the Third Age, is a brief summary of the events of The Lord of the Rings and those that led to them.
        
        The book shows the influence of many sources, including the Finnish epic Kalevala, Greek mythology in the lost island of Atlantis (as Númenor) and the Olympian gods (in the shape of the Valar, though these also resemble the Norse Æsir).
        
        Because J. R. R. Tolkien died leaving his legendarium unedited, Christopher Tolkien selected and edited materials to tell the story from start to end. In a few cases, this meant that he had to devise completely new material, within the tenor of his father's thought, to resolve gaps and inconsistencies in the narrative,[3] particularly Chapter 22, \"Of the Ruin of Doriath\".[4]
        
        The Silmarillion received a generally poor reception on publication; it sold much less well than The Lord of the Rings. Scholars found the work problematic, not least because the book is a construction, not authorised by Tolkien himself,[5] from the large corpus of documents and drafts also called \"The Silmarillion\". Scholars have noted that Tolkien intended the work to be a mythology, penned by many hands, and redacted by a fictional editor, whether Ælfwine or Bilbo Baggins. As such, the scholar Gergely Nagy considers that the fact that the work has indeed been edited actually realises Tolkien's intention.";

        $book6 = new Book();
        $book6->BookID = 5;
        $book6->Title = "Unfinished Tales of Numenor and Middle-Earth";
        $book6->Author = "J.R.R Tolkien";
        $book6->Genre = "Fantasy";
        $book6->Price = 7.99;
        $book6->ImagePath = "img/unfinished_tales_of_numenor_middle_earth.jpg";

        $book7 = new Book();
        $book7->BookID = 6;
        $book7->Title = "The Fall of Numenor";
        $book7->Author = "J.R.R Tolkien";
        $book7->Genre = "Fantasy";
        $book7->Price = 7.99;
        $book7->ImagePath = "img/fall_of_numenor.jpg";

        $book8 = new Book();
        $book8->BookID = 7;
        $book8->Title = "Harry Potter and the Philosopher's Stone";
        $book8->Author = "J.K. Rowling";
        $book8->Genre = "Fantasy";
        $book8->Price = 7.99;
        $book8->ImagePath = "img/harry_potter_philosophers_stone.png";

        $book9 = new Book();
        $book9->BookID = 8;
        $book9->Title = "Harry Potter and the Chamber of Secrets";
        $book9->Author = "J.K. Rowling";
        $book9->Genre = "Fantasy";
        $book9->Price = 7.99;
        $book9->ImagePath = "img/harry_potter_chamber_of_secrets.png";

        $book10 = new Book();
        $book10->BookID = 9;
        $book10->Title = "Harry Potter and the Prisoner of Azkaban";
        $book10->Author = "J.K. Rowling";
        $book10->Genre = "Fantasy";
        $book10->Price = 7.99;
        $book10->ImagePath = "img/harry_potter_prisoner_of_azkaban.png";

        $book11 = new Book();
        $book11->BookID = 10;
        $book11->Title = "Harry Potter and the Goblet of Fire";
        $book11->Author = "J.K. Rowling";
        $book11->Genre = "Fantasy";
        $book11->Price = 7.99;
        $book11->ImagePath = "img/harry_potter_goblet_of_fire.png";

        $book12 = new Book();
        $book12->BookID = 11;
        $book12->Title = "Harry Potter and the Order of the Phoenix";
        $book12->Author = "J.K. Rowling";
        $book12->Genre = "Fantasy";
        $book12->Price = 7.99;
        $book12->ImagePath = "img/harry_potter_order_of_the_phoenix.png";

        $book13 = new Book();
        $book13->BookID = 12;
        $book13->Title = "Harry Potter and the Half Blood Prince";
        $book13->Author = "J.K. Rowling";
        $book13->Genre = "Fantasy";
        $book13->Price = 7.99;
        $book13->ImagePath = "img/harry_potter_order_of_the_phoenix.png";

        $book14 = new Book();
        $book14->BookID = 13;
        $book14->Title = "Harry Potter and the Deathly Hallows";
        $book14->Author = "J.K. Rowling";
        $book14->Genre = "Fantasy";
        $book14->Price = 7.99;
        $book14->ImagePath = "img/harry_potter_and_the_deathly_hallows.jpg";

        $book15 = new Book();
        $book15->BookID = 14;
        $book15->Title = "The Hunger Games";
        $book15->Author = "Suzanne Collins";
        $book15->Genre = "Fantasy";
        $book15->Price = 7.99;
        $book15->ImagePath = "img/the_hunger_games.jpg";

        $book16 = new Book();
        $book16->BookID = 15;
        $book16->Title = "The Hunger Games: Catching Fire";
        $book16->Author = "Suzanne Collins";
        $book16->Genre = "Fantasy";
        $book16->Price = 7.99;
        $book16->ImagePath = "img/the_hunger_games_catching_fire.jpg";

        $book17 = new Book();
        $book17->BookID = 16;
        $book17->Title = "The Hunger Games: Mockingjay";
        $book17->Author = "Suzanne Collins";
        $book17->Genre = "Fantasy";
        $book17->Price = 7.99;
        $book17->ImagePath = "img/the_hunger_games_mockingjay.jpg";

        $book18 = new Book();
        $book18->BookID = 17;
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

        return $books;
    }
?>