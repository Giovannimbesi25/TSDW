<html>
    <head><title>Studenti</title></head>
    <body>
    <?php

        $conn = new mysqli("localhost", "root", "giovanni", "php_db") or die("Can't connect to database");
        // $sqlStudenti = "CREATE TABLE studenti (
        //     matricola INT AUTO_INCREMENT PRIMARY KEY,
        //     nome VARCHAR(30) NOT NULL,
        //     cognome VARCHAR(30) NOT NULL,
        //     facolta VARCHAR(30) NOT NULL
        // )";
        // $sqlEsami = "CREATE TABLE esami (
        //     codice INT AUTO_INCREMENT PRIMARY KEY,
        //     nome VARCHAR(30) NOT NULL,
        //     voto INT NOT NULL,
        //     studente INT NOT NULL REFERENCES studente(matricola)
        // )";
        
        // $conn->query($sqlStudenti);
        // $conn->query($sqlEsami);
        

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            //Pagina dettaglio studente
            if($_GET['matricola']){
                $matricola = $_GET['matricola'];
                echo "<h1>Dettaglio studente matricola " . $matricola . "</h1>";

                $sql = "SELECT * from studenti WHERE matricola=?";
                $stm = $conn->prepare($sql);
                $stm->bind_param("i", $matricola);
                if($stm->execute()){
                    $result = $stm->get_result();
                    $studente = $result->fetch_assoc();
                    ?>
                    <h3>Nome: <?= $studente['nome'] ?> </h3>
                    <h3>Cognome: <?= $studente['cognome'] ?> </h3>
                    <h3>Facolta: <?= $studente['facolta'] ?> </h3>
                    <?php
                    $sql = "SELECT * from esami WHERE studente = ?";
                    $stm=$conn->prepare($sql);
                    $stm->bind_param("i", $matricola);
                    
                    if($stm->execute()){
                        $result = $stm->get_result();
                        if($result->num_rows > 0){
                            $esami = $result->fetch_all(MYSQLI_ASSOC);
                            echo "<br><h3>Esami sostenuti</h3>";
                            echo "<ul>";
                            foreach($esami as $esame){
                                ?>
                                <li>
                                <form method="post">
                                <input hidden name="codice" value=<?= $esame['codice'] ?> />
                                <input hidden name="studente" value=<?= $esame['studente'] ?> />
                                <h4><input required value=<?= $esame['nome'] ?> name="nome"  /></h4>
                                <h4><input required value=<?= $esame['voto'] ?> name="voto"  /></h4>
                                <input type="submit" value="modificaEsame" name="action"/>
                                <input type="submit" value="rimuoviEsame" name="action"/>
                                </form>
                                </li>
                                <?php
                            }
                            echo "</ul>";                     
                        }else{
                            echo "<br><h3>Lo studente non ha sostenuto alcun esame</h3>";
                        }
                        $stm->close();
                    }   
                }

                ?>
                <br><h2>Aggiungi un nuovo esame</h2>
                <form method="post">
                    <h4>NomeEsame: <input required type="text" name="nome" /></h4>
                    <h4>Voto: <input required type="number" name="voto" /> </h4>
                    <input hidden type="text" name="studente" value=<?= $matricola ?> />
                    <h4><input type="submit" value="inserisciEsame" name="action" /></h4>
                </form>
                <?php


                echo "<br><br><a href='index.php'><h4>Ritorna alla home</h4></a>";

            }else{
                echo "<h1>Benvenuto nel registro degli studenti</h1>";

                //LISTA STUDENTI PAGINA INIZIALE

                $sql = "SELECT * from studenti";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $studenti = $result->fetch_all(MYSQLI_ASSOC);

                    echo "<ul>";
                    foreach($studenti as $studente){
                        ?>
                        <li>
                        <a href="index.php?matricola=<?= $studente['matricola'] ?>"><h4>Nome: <?= $studente['nome'] ?> </h4></a>
                        <h4>Cognome: <?= $studente['cognome'] ?> </h4>
                        <h4>Facolta: <?= $studente['facolta'] ?> </h4>
                        </li>
                        <?php
                    }
                    echo "</ul>";
                }else{
                    echo "<h2>La lista degli studenti risulta vuota</h2>";
                }

                ?>
                <br><h3>Aggiungi un nuovo studente al registro</h3>
                <form method="post">
                    <h4>Nome: <input type="text" required name="nome" /></h4>
                    <h4>Cognome: <input type="text" required name="cognome"/></h4>
                    <h4>Facolta: <input type="text" required name="facolta" /></h4>
                    <h4><input type="submit" value="inserisciStudente" name="action"/></h4>
                </form>

                <?php
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $action = $_POST['action'];
            switch($action){
                case "inserisciStudente" : {
                    $sql = "INSERT INTO studenti (nome,cognome, facolta) VALUES (?,?,?)";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("sss", $_POST['nome'],$_POST['cognome'], $_POST['facolta']);
                    $stm->execute();
                    $stm->close();

                    header("Location: /index.php");
                }break;

                case "inserisciEsame" : {
                    $sql = "INSERT INTO esami (nome,voto, studente) VALUES (?,?,?)";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("sii", $_POST['nome'],$_POST['voto'], $_POST['studente']);
                    $stm->execute();
                    $stm->close();

                    header("Location: /index.php?matricola=".$_POST['studente']);
                }break;

                case "modificaEsame": {
                    $sql = "UPDATE esami SET nome=?, voto = ? WHERE codice=?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("sii", $_POST['nome'], $_POST['voto'], $_POST['codice']);
                    $stm->execute();
                    $stm->close();
                    header("Location: /index.php?matricola=".$_POST['studente']);
                }break;
                case "rimuoviEsame": {
                    $sql = "DELETE FROM esami WHERE codice=?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("i", $_POST['codice']);
                    $stm->execute();
                    $stm->close();
                    header("Location: /index.php?matricola=".$_POST['studente']);
                }break;
            }
        }


        

        $conn->close();
        ?>
    </body>
</html>