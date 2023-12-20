<html>
    <head><title>Books2</title></head>
<body>

    <?php

    $conn = new mysqli("localhost", "root", "giovanni", "php_db") or die("Connection error");

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        echo "<h1>Benvenuto nella tua libreria</h1>";
        echo "<h2>Aggiungi un libro</h2>";

        ?>
        <form method="post">
            <h4>ISBN <input type="text" name="isbn" required /></h4>
            <h4>Title <input type="text" name="title" required /></h4>
            <h4>Publisher <input type="text" name="publisher" required /></h4>
            <h4>Price <input type="number" name="price" required /></h4>
            <select name="author">
                <?php
                $sql = "SELECT * from authors";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $authors = $result->fetch_all(MYSQLI_ASSOC);
                    foreach($authors as $author){
                        ?>
                        <option value = "<?= $author['id'] ?>" ><?= $author['firstname'] ?>  <?= $author['lastname'] ?> </option>
                        <?php
                    }
                }
                ?>
                
            </select>

            <select name="country">
                <?php
                $sql = "SELECT * from country";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $countries = $result->fetch_all(MYSQLI_ASSOC);
                    foreach($countries as $country){
                        ?>
                        <option value = "<?= $country['id'] ?>" ><?= $country['nicename'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            
            <input type="submit" value="insert" name="action" />
        </form>
        <br><br>
        <?php
	//Volendo si potrebbe fare con la stessa select che c'è sopra ma non è specificato

        echo "<h2>Cerca i libri del tuo autore preferito</h2>";
        ?>
        <form method="post">
            <h3>Title <input type="text" required name="firstname"></h3>
            <input type="submit" name="action" value="search" />
        </form>
        <?php
    }



    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['action'] == null) return;

        $action = $_POST['action'];
        switch($action) {
            case "insert" : {
                $isbn = $_POST['isbn'];
                $title = $_POST['title'];
                $author = $_POST['author'];
                $publisher = $_POST['publisher'];
                $country = $_POST['country'];

                $sqlCountry = "SELECT * FROM country WHERE id = '$country'";
                $resultCountry = $conn->query($sqlCountry);
                $countryResult = $resultCountry->fetch_assoc();
                if($countryResult['nicename'] == "Italy"){
                    $price = $_POST['price'] * 1.1;
                }else{
                    $price = $_POST['price'] * 1.2;
                }
                
                $sql = "INSERT INTO books2 (isbn, title, author, publisher, country, price) VALUES('$isbn', '$title','$author','$publisher','$country','$price')";
                $conn->query($sql);

                header("Location: /");
            }break;

            case "search" : {
                $firstname = $_POST['firstname'];
                $sql = "SELECT id FROM authors WHERE firstname='$firstname'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $author = $result->fetch_assoc();
                    $id_author = $author['id'];
                    echo "<h1>Libri scritti da " . $firstname . "</h1>";

                    $sqlBooks = "SELECT * FROM books2 WHERE author='$id_author'";
                    $resultBooks = $conn->query($sqlBooks);
                    
                    if($resultBooks->num_rows > 0){
                        $books = $resultBooks->fetch_all(MYSQLI_ASSOC);
                        echo "<ul>";
                        foreach($books as $book){
                            ?>
                            <li>
                            <h4>ISBN: <?= $book["isbn"] ?></h4>
                            <h4>Title: <?= $book["title"] ?></h4>
                            <h4>Author: <?= $book["author"] ?></h4>
                            <h4>Publisher: <?= $book["publisher"] ?></h4>
                            <h4>Country: <?= $book["country"] ?></h4>
                            <h4>Price: <?= $book["price"] ?></h4>
                            </li>
                            <br>
                            
                            <?php
                        }
                        echo "</ul>";
                    }else{
                        echo "<h2>Questo authore non ha scritto nessun libro</h2>";
                    }
                }else{
                    echo "<h1>Autore non trovato</h1>";
                }
            }break;
        }
        
    }
?>

</body>
</html>
