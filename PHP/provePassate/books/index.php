<html>
    <head>
        <title>Libreria</title>
</head>

<?php   

    require_once("database.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_POST['action'];
        switch($action){

            case 'list' ; {
                $books = getAll();
                echo "<ul>";
                foreach($books as $book){
                    ?>
                    <li>
                    <h4>ISBN: <a href="update.php?isbn=<?= $book['isbn'] ?>"><?= $book['isbn'] ?></a></h4>
                    <h4>Title: <?= $book['title'] ?></h4>
                    <h4>Author: <?= $book['author'] ?></h4>
                    <h4>Ranking: <?= $book['ranking'] ?></h4>
                    <h4>Year: <?= $book['year'] ?></h4>
                    <h4>Price: <?= $book['price'] ?></h4>
                    <br><br>
                    </li>
                    <?php
                }
                echo "</ul";
                
            }break;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        ?>
        <body>
            <h1>Benvenuto nella tua libreria</h1>
            
        <form method="post">
        <input value="list" name="action" type="submit"/>
        </form>
        <?php
    }
    


