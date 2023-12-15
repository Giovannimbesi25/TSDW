<html>
    <head><title>Prodotti</title></head>
<body>
    <?php
        $conn = new mysqli("localhost", "root", "giovanni", "php_db") or die("Errore nella connessione al db");
        // //CREAZIONE DATABASE SE NON ESISTE
        // $sql= "CREATE TABLE prodotti (
        //     id INT(6) AUTO_INCREMENT PRIMARY KEY,
        //     nome_prodotto VARCHAR(30) NOT NULL,
        //     giacenza SMALLINT NOT NULL,
        //     prezzo FLOAT NOT NULL
        // )";
        // $conn->query($sql);

        if($_SERVER['REQUEST_METHOD'] == "GET"){
            echo "<h1>Benvenuto nel tuo magazzino</h1>";
            $sql = "SELECT * FROM prodotti WHERE giacenza > 0";
            $result=$conn->query($sql);
            if($result->num_rows > 0){
                $prodotti = $result->fetch_all(MYSQLI_ASSOC);
                echo "<ul>";
                foreach($prodotti as $prodotto){
                    ?>
                    <li>
                    <form method="post">
                        <input value=<?= $prodotto['id']?> name="id" hidden />
                        <h4>Nome: <input name="nome" value=<?= $prodotto['nome_prodotto'] ?> /></h4>
                        <h4>Giacenza: <input name="giacenza" value=<?= $prodotto['giacenza'] ?> /></h4>
                        <h4>Prezzo: <input name="prezzo" value=<?= $prodotto['prezzo'] ?> /></h4>
                        <input name="action" type="submit" value="compra"/>
                        <input name="action" type="submit" value="elimina"/>
                    </form>
                    </li>
                    <?php
                }
                echo "</ul>";
            }else{
                echo "<h2>Non ci sono prodotti</h2>";
            }

        }


        echo "<br><h3>Aggiungi un prodotto</h3>";
        ?>
        <form method="post">
        <h4>Nome: <input name="nome" required type="text" /></h4>
        <h4>Giacenza: <input name="giacenza" required type="number" /></h4>
        <h4>Prezzo: <input name="prezzo" required type="number" /></h4>
        <h4><input name="action" type="submit" value="inserisci"/></h4>
        </form>

        <?php

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $action = $_POST['action'];
            switch($action){
                case 'inserisci' : {
                $sql = "INSERT INTO prodotti (nome_prodotto, giacenza, prezzo) VALUES (?, ?, ?)";
                $stm = $conn->prepare($sql);
                $stm->bind_param("sid", $_POST['nome'], $_POST['giacenza'], $_POST['prezzo']);
                if ($stm->execute()) {
                    header("Location: /");
                } 
                $stm->close();

                }break;

                case 'compra' : {
                    $giacenza = $_POST['giacenza']-1;
                    $sql = "UPDATE prodotti SET giacenza = ? WHERE id = ?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("ii", $giacenza, $_POST['id']);
                    if ($stm->execute()) {
                        header("Location: /");
                    } 
                    $stm->close();
    
                }break;

                case 'elimina' : {
                    $sql = "DELETE FROM  prodotti  WHERE id = ?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("i", $_POST['prezzo']);
                    if ($stm->execute()) {
                        header("Location: /");
                    } 
                    $stm->close();
    
                }break;
            }


        }
    ?>
</body>
</html>