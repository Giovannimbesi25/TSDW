<html>
    <head><title>Fumetti Store</title></head>
<body>
    <?php
    $conn = new mysqli("localhost", "root","giovanni","php_db") or die("Connection to database error");

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if($_GET['id'] != null){
            $id = $_GET['id'];
            //SHOW FUMETTO INFO
            echo "<h1>About Page</h1>";
            $sql = "SELECT * FROM fumetti WHERE id=$id";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $fumetto = $result->fetch_assoc();
                ?>
                <form method="post">
                <input hidden value=<?= $fumetto['id'] ?> name="id" />
                <h3>Titolo: <input value="<?= $fumetto['titolo'] ?>" name="titolo" type="text" required />
                <h3>Genere: <input value="<?= $fumetto['genere'] ?>" name="genere" type="text" required />
                <h3>Autore: <input value="<?= $fumetto['autore'] ?> "name="autore" type="text" required />
                <input type="submit" value="update" name="action" />
                <input type="submit" value="delete" name="action" />
                </form>
                <?php
            }else{
                echo "<h1>Questo fumetto non esiste</h1>";
            }

            echo "<br><br><br><br><a href='index.php'><h3>Torna alla home</h3></a>";
        }else{
            echo "<h1>Benvenuto nel fumetti store</h1>";
            //Lista di ultime aggiunte
            echo "<h2>Ultime aggiunte</h2>";
            $sql = "SELECT * FROM fumetti ORDER BY id DESC LIMIT 5";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $fumetti = $result->fetch_all(MYSQLI_ASSOC);
                echo "<ul>";
                foreach($fumetti as $fumetto){
                    ?>
                    <li>
                    <a href="?id=<?= $fumetto['id'] ?>"><h3><?= $fumetto['titolo'] ?></h3></a>
                    </li>
                    <?php
                }
                echo "</ul>";
            }

            echo "<br><br><h2>Cerca un fumetto</h2>";
            ?>
            <form method="post">
                <h3>Titolo <input  name="titolo" required /></h3>
                <input type="submit" value="search" name="action"/>
            </form>
            <?php
        }

    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $action = $_POST['action'];
        switch($action){
            case "search" : {
                $titolo = $_POST["titolo"];
                $sql = "SELECT * FROM fumetti WHERE titolo='$titolo' ";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $fumetto = $result->fetch_assoc();
                    header("Location: ?id=".$fumetto['id']);
                }else{
                    echo "<h1>Il fumetto non è stato trovato, aggiungilo alla lista</h1>";
                    ?>
                    <form method="post">
                    <h3>Titolo  <input value="<?= $titolo ?>" name="titolo" type="text" required /></h3>
                    <h3>Genere  <input name="genere" type="text" required /></h3>
                    <h3>Autore  <input name="autore" type="text" required /></h3>
                    <input type="submit" value="aggiungi" name="action" />
                    </form>
                    <?php
                }
                
            }break;

            case "aggiungi" : {
                $titolo = $_POST["titolo"];
                $autore = $_POST["autore"];
                $genere = $_POST["genere"];
                $sql = "INSERT INTO fumetti (titolo, genere, autore) VALUES('$titolo', '$genere', '$autore')";
                $conn->query($sql);
                header("Location: /index.php");
            }break;

            case "update" : {
                $titolo = $_POST["titolo"];
                $autore = $_POST["autore"];
                $genere = $_POST["genere"];
                $id = $_POST["id"];
                $sql = "UPDATE fumetti SET titolo='$titolo', genere='$genere', autore='$autore' WHERE id='$id'";
                $conn->query($sql);
                header("Location: /index.php?id=".$id);
            }break;
            
            case "delete" : {
                $id = $_POST["id"];
                $sql = "DELETE FROM fumetti WHERE id='$id'";
                $conn->query($sql);
                header("Location: /index.php");
            }break;
        }
    }

?>

</body>
</html>