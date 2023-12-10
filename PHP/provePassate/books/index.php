<html>
    <head>
        <title>Libreria</title>
</head>
<body>
<?php   

    $conn = new mysqli("localhost", "root", "giovanni", "php_db");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_POST['action'];
        switch($action){

            case 'list' : {
                echo "<h2>Lista Libri</h2>";

                $sql = "SELECT * from books";
                $result = $conn->query($sql);
                $books = $result->fetch_all(MYSQLI_ASSOC);
                if($books != null){
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
                }else{
                    echo "Nessun libro nella libreria";
                }
                ?>  
                <br><br>
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

                $sql = "INSERT INTO books (isbn, title, author, ranking, year, price) VALUES(?,?,?,?,?,?)";
                $stm = $conn->prepare($sql);
                $stm->bind_param("ssssss", $isbn, $title, $author, $ranking, $year, $price);
                if($stm->execute()){
                    header("Location: index.php");
                }else{
                    echo "Errore aggiunta libro";
                }         
                $stm->close();       
            }break;

            case 'update' ; {
                $isbn = $_POST['isbn'];
                $title = $_POST['title'];
                $author = $_POST['author'];
                $ranking = $_POST['ranking'];
                $year = $_POST['year'];
                $price = $_POST['price'];

                $sql = "UPDATE books SET title= ?, author = ?, ranking=?, year=?, price=?";
                $stm = $conn->prepare($sql);
                $stm->bind_param("sssss", $title, $author, $ranking, $year, $price);
                if($stm->execute()){
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
                $sql = "DELETE from books WHERE isbn = ?";
                $stm = $conn->prepare($sql);
                $stm->bind_param("s", $isbn);
                if($stm->execute()){
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
            $sql = "SELECT * from books WHERE isbn=?";
            $stm = $conn->prepare($sql);
            $stm->bind_param("s", $isbn);
            if($stm->execute()){
                $result = $stm->get_result();
                $book = $result->fetch_assoc();
                ?>
                <form method="post">
                <h4>ISBN: <input value="<?= $isbn ?>" name="isbn" required type="text"?></h4>
                <h4>Title: <input value="<?= $book['title']?>" name="title" required type="text" /></h4>
                <h4>Author: <input value="<?= $book['author']?>" name="author" required type="text" /></h4>
                <h4>Ranking: <input value="<?= $book['ranking']?>" name="ranking" required type="text" /></h4>
                <h4>Year: <input value="<?= $book['year']?>" name="year" required type="text" /></h4>
                <h4>Price: <input value="<?= $book['price']?>" name="price" required type="text" /></h4>
                <input name="action" value="update" type="submit" />
                <input name="action" value="delete" type="submit" />
                </form>

                <br><br>

                <a href="index.php">Ritorna alla pagina principale</a>

                <?php
            }else{
                echo "Error retrieving book";
            }
            

        }else{

            ?>


            <body>
                <h1>Benvenuto nella tua libreria</h1>
                
            <form method="post">
            <input value="list" name="action" type="submit"/>
            </form>
            <?php
        }

        $conn->close();
        
    }
?>
</body>
</html>
    


