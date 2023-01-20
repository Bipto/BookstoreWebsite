<?php

    require_once "database_connections.php";

    function createDatabase($conn)
    {
        //create database statement
        $sql = "CREATE DATABASE Bookstore";

        //attempt to execute query
        if ($conn->query($sql) === TRUE)
        {
            echo "Database created successfully";
        }
        else
        {
            echo "Error creating database: " . $conn->error;
        }

        echo "<br>";
    }

    function createBooksTable($conn){
        $create_books_sql = "CREATE TABLE Bookstore.Books(
            BookID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            Title VARCHAR(50) NOT NULL,
            Author VARCHAR(50) NOT NULL,
            BookDescription TEXT NOT NULL,
            Genre VARCHAR(30) NOT NULL,
            Price DECIMAL(6,2) NOT NULL,
            ImagePath VARCHAR(150) 
            )";
    
        if ($conn->query($create_books_sql) === TRUE){
            echo "Table Books created successfully";
        }
        else{
            echo "Error creating table (Books): " . $conn->error;
        }

        echo "<br>";
    }

    function createAdminTable($conn){
        $create_administrators_sql = "CREATE TABLE Bookstore.Administrators(
            Email VARCHAR(50) PRIMARY KEY NOT NULL,
            Title VARCHAR(10) NOT NULL,      
            FirstName VARCHAR(30) NOT NULL,
            Surname VARCHAR(50) NOT NULL,
            DateOfBirth DATETIME NOT NULL,
            HouseNumber VARCHAR(30)NOT NULL,
            Street VARCHAR(50) NOT NULL,
            Town VARCHAR(50) NOT NULL,
            County VARCHAR(50) NOT NULL,
            Country VARCHAR(50) NOT NULL,
            PostCode VARCHAR(7) NOT NULL,
            Password VARCHAR(255) NOT NULL
            )";
    
        if ($conn->query($create_administrators_sql) === TRUE){
            echo "Table Administrators created successfully";
        }
        else{
            echo "Error creating table (Administrators): " . $conn->error;
        }

        echo "<br>";    
    }

    function createCustomerTable($conn){
        $create_customers_sql = "CREATE TABLE Bookstore.Customers(
            Email VARCHAR(50) PRIMARY KEY NOT NULL,
            Title VARCHAR(10) NOT NULL,
            FirstName VARCHAR(30) NOT NULL,
            Surname VARCHAR(50) NOT NULL,
            DateOfBirth DATETIME NOT NULL,
            HouseNumber VARCHAR(30) NOT NULL,
            Street VARCHAR(50) NOT NULL,
            Town VARCHAR(50) NOT NULL,
            County VARCHAR(50) NOT NULL,
            Country VARCHAR(50) NOT NULL,
            PostCode VARCHAR(7) NOT NULL,
            Password VARCHAR(255) NOT NULL
            )";

        if ($conn->query($create_customers_sql) === TRUE){
            echo "Table Customers created successfully";
        }
        else{
            echo "Error creating table (Customers): " . $conn->error;
        }

        echo "<br>";
    }

    function createOrdersTable($conn){
        $create_orders_sql = "CREATE TABLE Bookstore.Orders(
            OrderID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            AccountEmail VARCHAR(50) NOT  NULL,
            FOREIGN KEY (AccountEmail) REFERENCES Bookstore.Customers(Email),
            Total DECIMAL(6,2) NOT NULL,
            Date DATETIME NOT NULL,
            OrderEmail VARCHAR(50) NOT NULL,
            HouseNumber VARCHAR(30) NOT NULL,
            Street VARCHAR(50) NOT NULL,
            County VARCHAR(50) NOT NULL,
            Country VARCHAR(50) NOT NULL,
            PostCode VARCHAR(7) NOT NULL
            )";

        if ($conn->query($create_orders_sql) === TRUE){
            echo "Table Orders created successfully";
        }
        else{
            echo "Error creating table (Orders): " . $conn->error;
        }

        echo "<br>";
    }
    
    function createBookSalesTable($conn){
        $create_book_sales_sql = "CREATE TABLE Bookstore.BookSales(
            BookSaleID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            BookID INT UNSIGNED NOT NULL,
            FOREIGN KEY (BookID) REFERENCES Bookstore.Books(BookID),
            OrderID INT UNSIGNED NOT NULL,
            FOREIGN KEY (OrderID) REFERENCES Bookstore.Orders(OrderID)
            )";

        if ($conn->query($create_book_sales_sql) === TRUE){
            echo "Table BookSales created successfully";
        }
        else{
            echo "Error creating table (BookSales): " . $conn->error;
        }

        echo "<br>";
    }

    function createCartTable($conn){
        $create_cart_sql = "CREATE TABLE Bookstore.Carts(
            CartID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            Email VARCHAR(50) NOT NULL,
            FOREIGN KEY (Email) REFERENCES Bookstore.Customers(Email),
            BookID INT(6) UNSIGNED NOT NULL,
            FOREIGN KEY(BookID) REFERENCES Bookstore.Books(BookID)
            )";

            if ($conn->query($create_cart_sql) === TRUE){
                echo "Table Carts create successfully";
            }
            else{
                echo "Error creating table (Carts): " .$conn->error;
            }

            echo "<br>";
    }

    function createBooks($conn){
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
        insertBook($book1, $conn);

        $book2 = new Book();
        $book2->BookID = 1;
        $book2->Title = "The Fellowship of the Ring";
        $book2->Author = "J.R.R Tolkien";
        $book2->Genre = "Fantasy";
        $book2->Price = 7.99;
        $book2->ImagePath = "img/fellowship_of_the_ring.png";
        $book2->Description = "The Fellowship of the Ring is the first of three volumes of the epic novel[2] The Lord of the Rings by the English author J. R. R. Tolkien. It is followed by The Two Towers and The Return of the King. It takes place in the fictional universe of Middle-earth, and was originally published on 29 July 1954 in the United Kingdom.
        The volume consists of a foreword, in which the author discusses his writing of The Lord of the Rings, a prologue titled \"Concerning Hobbits, and other matters\", and the main narrative in Book I and Book II.";
        insertBook($book2, $conn);

        $book3 = new Book();
        $book3->BookID = 2;
        $book3->Title = "The Two Towers";
        $book3->Author = "J.R.R Tolkien";
        $book3->Genre = "Fantasy";
        $book3->Price = 7.99;
        $book3->ImagePath = "img/the_two_towers.png";
        $book3->Description = "The Two Towers is the second volume of J. R. R. Tolkien's high fantasy novel The Lord of the Rings. It is preceded by The Fellowship of the Ring and followed by The Return of the King.";
        insertBook($book3, $conn);

        $book4 = new Book();
        $book4->BookID = 3;
        $book4->Title = "The Return of the King";
        $book4->Author = "J.R.R Tolkien";
        $book4->Genre = "Fantasy";
        $book4->Price = 7.99;
        $book4->ImagePath = "img/the_return_of_the_king.png";
        $book4->Description = "The Return of the King is the third and final volume of J. R. R. Tolkien's The Lord of the Rings, following The Fellowship of the Ring and The Two Towers. It was published in 1955. The story begins in the kingdom of Gondor, which is soon to be attacked by the Dark Lord Sauron.";
        insertBook($book4, $conn);

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
        insertBook($book5, $conn);

        $book6 = new Book();
        $book6->BookID = 5;
        $book6->Title = "Unfinished Tales of Numenor and Middle-Earth";
        $book6->Author = "J.R.R Tolkien";
        $book6->Genre = "Fantasy";
        $book6->Price = 7.99;
        $book6->ImagePath = "img/unfinished_tales_of_numenor_middle_earth.jpg";
        $book6->Description = "Unfinished Tales of Númenor and Middle-earth is a collection of stories and essays by J. R. R. Tolkien that were never completed during his lifetime, but were edited by his son Christopher Tolkien and published in 1980. Many of the tales within are retold in The Silmarillion, albeit in modified forms; the work also contains a summary of the events of The Lord of the Rings told from a less personal perspective.";
        insertBook($book6, $conn);

        $book7 = new Book();
        $book7->BookID = 6;
        $book7->Title = "The Fall of Numenor";
        $book7->Author = "J.R.R Tolkien";
        $book7->Genre = "Fantasy";
        $book7->Price = 7.99;
        $book7->ImagePath = "img/fall_of_numenor.jpg";
        $book7->Description = "The Fall of Númenor is a fantasy work collecting all J. R. R. Tolkien's Second Age writings together. It is edited by Brian Sibley. The book uses \"The Tale of Years\" in the Appendices of The Lord of the Rings to present the content of the Second Age. The stories include the foundation of Númenor, the forging of the Rings of Power, and the Last Alliance against Sauron that ended the Second Age. The editor, Brian Sibley, has provided new introductions and commentaries to unify Tolkien's writings. The publication contains ten new colour paintings by Alan Lee. The book published on 15 November 2022.";
        insertBook($book7, $conn);

        $book8 = new Book();
        $book8->BookID = 7;
        $book8->Title = "Harry Potter and the Philosopher's Stone";
        $book8->Author = "J.K. Rowling";
        $book8->Genre = "Fantasy";
        $book8->Price = 7.99;
        $book8->ImagePath = "img/harry_potter_philosophers_stone.png";
        $book8->Description = "Harry Potter and the Philosopher's Stone is a 1997 fantasy novel written by British author J. K. Rowling. The first novel in the Harry Potter series and Rowling's debut novel, it follows Harry Potter, a young wizard who discovers his magical heritage on his eleventh birthday, when he receives a letter of acceptance to Hogwarts School of Witchcraft and Wizardry. Harry makes close friends and a few enemies during his first year at the school and with the help of his friends, Ron Weasley and Hermione Granger, he faces an attempted comeback by the dark wizard Lord Voldemort, who killed Harry's parents, but failed to kill Harry when he was just 15 months old.";
        insertBook($book8, $conn);

        $book9 = new Book();
        $book9->BookID = 8;
        $book9->Title = "Harry Potter and the Chamber of Secrets";
        $book9->Author = "J.K. Rowling";
        $book9->Genre = "Fantasy";
        $book9->Price = 7.99;
        $book9->ImagePath = "img/harry_potter_chamber_of_secrets.png";
        $book9->Description = "Harry Potter and the Chamber of Secrets is a fantasy novel written by British author J. K. Rowling and the second novel in the Harry Potter series. The plot follows Harry's second year at Hogwarts School of Witchcraft and Wizardry, during which a series of messages on the walls of the school's corridors warn that the \"Chamber of Secrets\" has been opened and that the \"heir of Slytherin\" would kill all pupils who do not come from all-magical families. These threats are found after attacks that leave residents of the school petrified. Throughout the year, Harry and his friends Ron and Hermione investigate the attacks.";
        insertBook($book9, $conn);

        $book10 = new Book();
        $book10->BookID = 9;
        $book10->Title = "Harry Potter and the Prisoner of Azkaban";
        $book10->Author = "J.K. Rowling";
        $book10->Genre = "Fantasy";
        $book10->Price = 7.99;
        $book10->ImagePath = "img/harry_potter_prisoner_of_azkaban.png";
        $book10->Description = "Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series. The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry. Along with friends Ronald Weasley and Hermione Granger, Harry investigates Sirius Black, an escaped prisoner from Azkaban, the wizard prison, believed to be one of Lord Voldemort's old allies.";
        insertBook($book10, $conn);

        $book11 = new Book();
        $book11->BookID = 10;
        $book11->Title = "Harry Potter and the Goblet of Fire";
        $book11->Author = "J.K. Rowling";
        $book11->Genre = "Fantasy";
        $book11->Price = 7.99;
        $book11->ImagePath = "img/harry_potter_goblet_of_fire.png";
        $book11->Description = "Harry Potter and the Goblet of Fire is a fantasy novel written by British author J. K. Rowling and the fourth novel in the Harry Potter series. It follows Harry Potter, a wizard in his fourth year at Hogwarts School of Witchcraft and Wizardry, and the mystery surrounding the entry of Harry's name into the Triwizard Tournament, in which he is forced to compete. The book was published in the United Kingdom by Bloomsbury and in the United States by Scholastic. In both countries, the release date was 8 July 2000. This was the first time a book in the series was published in both countries at the same time. The novel won a Hugo Award, the only Harry Potter novel to do so, in 2001. The book was adapted into a film, released worldwide on 18 November 2005, and a video game by Electronic Arts.";
        insertBook($book11, $conn);

        $book12 = new Book();
        $book12->BookID = 11;
        $book12->Title = "Harry Potter and the Order of the Phoenix";
        $book12->Author = "J.K. Rowling";
        $book12->Genre = "Fantasy";
        $book12->Price = 7.99;
        $book12->ImagePath = "img/harry_potter_order_of_the_phoenix.png";
        $book12->Description = "";
        insertBook($book12, $conn);

        $book13 = new Book();
        $book13->BookID = 12;
        $book13->Title = "Harry Potter and the Half Blood Prince";
        $book13->Author = "J.K. Rowling";
        $book13->Genre = "Fantasy";
        $book13->Price = 7.99;
        $book13->ImagePath = "img/harry_potter_order_of_the_phoenix.png";
        $book13->Description = "Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series. It follows Harry Potter's struggles through his fifth year at Hogwarts School of Witchcraft and Wizardry, including the surreptitious return of the antagonist Lord Voldemort, O.W.L. exams, and an obstructive Ministry of Magic. The novel was published on 21 June 2003 by Bloomsbury in the United Kingdom, Scholastic in the United States, and Raincoast in Canada. It sold five million copies in the first 24 hours of publication.[1] Harry Potter and the Order of the Phoenix won several awards, including the American Library Association Best Book Award for Young Adults in 2003. The book was also made into a 2007 film, and a video game by Electronic Arts.";
        insertBook($book13, $conn);

        $book14 = new Book();
        $book14->BookID = 13;
        $book14->Title = "Harry Potter and the Deathly Hallows";
        $book14->Author = "J.K. Rowling";
        $book14->Genre = "Fantasy";
        $book14->Price = 7.99;
        $book14->ImagePath = "img/harry_potter_and_the_deathly_hallows.jpg";
        $book14->Description = "Harry Potter and the Deathly Hallows is a fantasy novel written by British author J. K. Rowling and the seventh and final novel of the main Harry Potter series. It was released on 21 July 2007 in the United Kingdom by Bloomsbury Publishing, in the United States by Scholastic, and in Canada by Raincoast Books. The novel chronicles the events directly following Harry Potter and the Half-Blood Prince (2005) and the final confrontation between the wizards Harry Potter and Lord Voldemort.";
        insertBook($book14, $conn);

        $book15 = new Book();
        $book15->BookID = 14;
        $book15->Title = "The Hunger Games";
        $book15->Author = "Suzanne Collins";
        $book15->Genre = "Young Adult";
        $book15->Price = 7.99;
        $book15->ImagePath = "img/the_hunger_games.jpg";
        $book15->Description = "The Hunger Games is a 2008 dystopian novel by the American writer Suzanne Collins. It is written in the perspective of 16-year-old Katniss Everdeen, who lives in the future, post-apocalyptic nation of Panem in North America. The Capitol, a highly advanced metropolis, exercises political control over the rest of the nation. The Hunger Games is an annual event in which one boy and one girl aged 12–18 from each of the twelve districts surrounding the Capitol are selected by lottery to compete in a televised battle royale to the death.";
        insertBook($book15, $conn);

        $book16 = new Book();
        $book16->BookID = 15;
        $book16->Title = "The Hunger Games: Catching Fire";
        $book16->Author = "Suzanne Collins";
        $book16->Genre = "Young Adult";
        $book16->Price = 7.99;
        $book16->ImagePath = "img/the_hunger_games_catching_fire.jpg";
        $book16->Description = "Catching Fire is a 2009 science fiction young adult novel by the American novelist Suzanne Collins, the second book in The Hunger Games series. As the sequel to the 2008 bestseller The Hunger Games, it continues the story of Katniss Everdeen and the post-apocalyptic nation of Panem. Following the events of the previous novel, a rebellion against the oppressive Capitol has begun, and Katniss and fellow tribute Peeta Mellark are forced to return to the arena in a special edition of the Hunger Games.";
        insertBook($book16, $conn);

        $book17 = new Book();
        $book17->BookID = 16;
        $book17->Title = "The Hunger Games: Mockingjay";
        $book17->Author = "Suzanne Collins";
        $book17->Genre = "Young Adult";
        $book17->Price = 7.99;
        $book17->ImagePath = "img/the_hunger_games_mockingjay.jpg";
        $book17->Description = "Mockingjay is a 2010 science fiction novel by American author Suzanne Collins. It is chronologically the last installment of The Hunger Games series, following 2008's The Hunger Games and 2009's Catching Fire. The book continues the story of Katniss Everdeen, who agrees to unify the districts of Panem in a rebellion against the tyrannical Capitol.";
        insertBook($book17, $conn);

        $book18 = new Book();
        $book18->BookID = 17;
        $book18->Title = "The Ballad of Songbirds and Snakes";
        $book18->Author = "Suzanne Collins";
        $book18->Genre = "Young Adult";
        $book18->Price = 7.99;
        $book18->ImagePath = "img/ballad_of_songbirds_and_snakes.jpg";
        $book18->Description = "The Ballad of Songbirds and Snakes is a dystopian action-adventure novel by American author Suzanne Collins. It is a spin-off and a prequel to The Hunger Games trilogy. It was released on May 19, 2020, by Scholastic. An audiobook of the novel read by American actor Santino Fontana was released simultaneously with the printed edition.[1] The book received a virtual launch due to the COVID-19 pandemic.[2] A film adaptation from Lionsgate is set to be released on November 17, 2023.";
        insertBook($book18, $conn);

        $book19 = new Book();
        $book19->BookID = 18;
        $book19->Title = "A Game of Thrones";
        $book19->Author = "George R.R. Martin";
        $book19->Genre = "Fantasy";
        $book19->Price = 12.50;
        $book19->ImagePath = "img/a_game_of_thrones.jpg";
        $book19->Description = "The first volume in the A Song of Ice and Fire series – unquestionably one of the greatest fantasy epics of all time. Here, we are introduced to the Seven Kingdoms of Westeros, and the major players with eyes on its Iron Throne. As noble families battle for power, greater threats face them all: for winter is coming to Westeros, and here, winter can last a lifetime.";
        insertBook($book19, $conn);

        $book20 = new Book();
        $book20->BookID = 19;
        $book20->Title = "A Clash of Kings";
        $book20->Author = "George R.R. Martin";
        $book20->Genre = "Fantasy";
        $book20->Price = 12.50;
        $book20->ImagePath = "img/a_clash_of_kings.jpg";
        $book20->Description = "From the ancient citadel of Dragonstone to the forbidding lands of Winterfell, chaos reigns as pretenders to the Iron Throne of the Seven Kingdoms stake their claims through tempest, turmoil and war.

        As a prophecy of doom cuts across the sky - a comet the colour of blood and flame - five factions struggle for control of a divided land. Brother plots against brother and the dead rise to walk in the night.";
        insertBook($book20, $conn);

        $book21 = new Book();
        $book21->BookID = 20;
        $book21->Title = "A Storm of Swords: Part 1 Steel and Snow";
        $book21->Author = "George R.R. Martin";
        $book21->Genre = "Fantasy";
        $book21->Price = 12.50;
        $book21->ImagePath = "img/a_storm_of_swords_part_1.jpg";
        $book21->Description = "Winter approaches Westeros like an angry beast.

        The Seven Kingdoms are divided by revolt and blood feud. In the northern wastes, a horde of hungry, savage people steeped in the dark magic of the wilderness is poised to invade the Kingdom of the North where Robb Stark wears his new-forged crown. And Robb's defences are ranged against the South, the land of the cunning and cruel Lannisters, who have his younger sisters in their power.
        
        Throughout Westeros, the war for the Iron Throne rages more fiercely than ever, but if the Wall is breached, no king will live to claim it.";
        insertBook($book21, $conn);

        $book22 = new Book();
        $book22->BookID = 21;
        $book22->Title = "A Storm of Swords: Part 2 Blood and Gold";
        $book22->Author = "George R.R. Martin";
        $book22->Genre = "Fantasy";
        $book22->Price = 12.50;
        $book22->ImagePath = "img/a_storm_of_swords_part_2.jpg";
        $book22->Description = "The Starks are scattered.

        Robb Stark may be King in the North, but he must bend to the will of the old tyrant Walder Frey if he is to hold his crown. And while his youngest sister, Arya, has escaped the clutches of the depraved Cersei Lannister and her son, the capricious boy-king Joffrey, Sansa Stark remains their captive.
        
        Meanwhile, across the ocean, Daenerys Stormborn, the last heir of the Dragon King, delivers death to the slave-trading cities of Astapor and Yunkai as she approaches Westeros with vengeance in her heart.";
        insertBook($book22, $conn);

        $book23 = new Book();
        $book23->BookID = 22;
        $book23->Title = "A Feast for Crows";
        $book23->Author = "George R.R. Martin";
        $book23->Genre = "Fantasy";
        $book23->Price = 12.50;
        $book23->ImagePath = "img/a_feast_for_crows.jpg";
        $book23->Description = "The Lannisters are in power on the Iron Throne.

        The war in the Seven Kingdoms has burned itself out, but in its bitter aftermath new conflicts spark to life. The Martells of Dorne and the Starks of Winterfell seek vengeance for their dead. Euron Crow's Eye, as black a pirate as ever raised a sail, returns from the smoking ruins of Valyria to claim the Iron Isles.
        
        From the icy north, where Others threaten the Wall, apprentice Maester Samwell Tarly brings a mysterious babe in arms to the Citadel. As plots, intrigue and battle threaten to engulf Westeros, victory will go to the men and women possessed of the coldest steel and the coldest hearts.";
        insertBook($book23, $conn);

        $book24 = new Book();
        $book24->BookID = 23;
        $book24->Title = "A Dance With Dragons: Part 1 Dreams and Dust";
        $book24->Author = "George R.R. Martin";
        $book24->Genre = "Fantasy";
        $book24->Price = 12.50;
        $book24->ImagePath = "img/a_dance_with_dragons_part_1.jpg";
        $book24->Description = "In the aftermath of a colossal battle, new threats are emerging from every direction.

        Tyrion Lannister, having killed his father, and wrongfully accused of killing his nephew, King Joffrey, has escaped from King's Landing with a price on his head.
        
        To the north lies the great Wall of ice and stone - a structure only as strong as those guarding it. Eddard Stark's son Jon Snow has been elected 998th Lord Commander of the Night's Watch. But Jon has enemies both inside and beyond the Wall. And in the east Daenerys Targaryen struggles to hold a city built on dreams and dust.";
        insertBook($book24, $conn);

        $book25 = new Book();
        $book25->BookID = 24;
        $book25->Title = "A Dance With Dragons: Part 2 After the Feast";
        $book25->Author = "George R.R. Martin";
        $book25->Genre = "Fantasy";
        $book25->Price = 12.50;
        $book25->ImagePath = "img/a_dance_with_dragons_part_2.jpg";
        $book25->Description = "The future of the Seven Kingdoms hangs in the balance.

        In King's Landing the Queen Regent, Cersei Lannister, awaits trial, abandoned by all those she trusted; while in the eastern city of Yunkai her brother Tyrion has been sold as a slave. From the Wall, having left his wife and the Red Priestess Melisandre under the protection of Jon Snow, Stannis Baratheon marches south to confront the Boltons at Winterfell. But beyond the Wall the wildling armies are massing for an assault...
        
        On all sides bitter conflicts are reigniting, played out by a grand cast of outlaws and priests, soldiers and skinchangers, nobles and slaves. The tides of destiny will inevitably lead to the greatest dance of all.";
        insertBook($book24, $conn);
    }

    $conn = openConnection();
    
    createDatabase($conn);
    createBooksTable($conn);
    createAdminTable($conn);
    createCustomerTable($conn);
    createOrdersTable($conn);
    createBookSalesTable($conn);
    createCartTable($conn);

    createBooks($conn);

    //close connection to database
    $conn->close();
    
?>