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
                    <h4>ISBN: <a href="index.php?isbn=<?= $book['isbn'] ?>"><?= $book['isbn'] ?></a></h4>
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

                ?>  

                <h2>Aggiungi un libro</h2>

                <form method="post">
                <h4>ISBN: <input required type="text" name="isbn"></h4>
                <h4>Title: <input  name="title" required type="text" /></h4>
                <h4>Author: <input name="author" required type="text" /></h4>
                <h4>Ranking: <input  name="ranking" required type="text" /></h4>
                <h4>Year: <input  name="year" required type="text" /></h4>
                <h4>Price: <input  name="price" required type="text" /></h4>
                <input name="action" value="insert" type="submit" />

                <?php
                
            }break;

            case 'insert' : {

                $isbn = $_POST['isbn'];
                $title = $_POST['title'];
                $author = $_POST['author'];
                $ranking = $_POST['ranking'];
                $year = $_POST['year'];
                $price = $_POST['price'];

                if(addBook($isbn, $title, $author, $ranking, $year, $price )){
                    echo "<h2>Libro inserito con successo</h2>";

                    
                    header("Location: index.php?");
                
                }else{
                    echo "Errore aggiunta libro";
                }
                
            }break;

            case 'update' ; {
                $isbn = $_POST['isbn'];
                $title = $_POST['title'];
                $author = $_POST['author'];
                $ranking = $_POST['ranking'];
                $year = $_POST['year'];
                $price = $_POST['price'];

                if(updateBook($isbn,$title, $author, $ranking, $year, $price )){
                    echo "<h2>Libro modificato con successo</h2>";
                    ?>
                    <?php
                    
                    header("Location: index.php?isbn=" . $isbn);

                }else{
                    echo "Errore update libro";
                }
                
            }break;

            case 'delete' ; {
                $isbn = $_POST['isbn'];
                
                if(deleteBook()){
                    echo "<h2>Libro eliminato con successo</h2>";
                    ?>
                    <a href="index.php">Ritorna alla pagina principale</a>
                    <?php
                }else{
                    echo "Error deleting book";
                }
                
            }break;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "GET"){

        if($_GET['isbn'] != null){
            $isbn = $_GET['isbn'];

            $book = getBook($isbn);
            ?>
            <form method="post">
            <h4>ISBN: <input value="<?= $isbn ?>" name="isbn" required type="text"?></h4>
            <h4>Title: <input value="<?= $book['title']?>" name="title" required type="text" /></h4>
            <h4>Author: <input value="<?= $book['author']?>" name="author" required type="text" /></h4>
            <h4>Ranking: <input value="<?= $book['ranking']?>" name="ranking" required type="text" /></h4>
            <h4>Year: <input value="<?= $book['year']?>" name="year" required type="text" /></h4>
            <h4>Price: <input value="<?= $book['price']?>" name="price" required type="text" /></h4>
            <input name="action" value="update" type="submit" />
            <input name="action" value="update" type="submit" />
            </form>

            <br><br>

            <a href="index.php">Ritorna alla pagina principale</a>

            <?php
            

        }else{

            ?>


            <body>
                <h1>Benvenuto nella tua libreria</h1>
                
            <form method="post">
            <input value="list" name="action" type="submit"/>
            </form>
            <?php
        }
    }
    


