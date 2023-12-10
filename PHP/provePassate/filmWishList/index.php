<html>
<head><title>FakeFlix</title></head>
<body>
<?php
    //localhost, username, password, dbname
    $conn = new mysqli("localhost", "root", "giovanni", "php_db") or die("Connection error");

    if($_SERVER['REQUEST_METHOD']=='GET'){
        echo "<h1>Benvenuto su fakeflix</h1><br>";
        $sql = "SELECT * from flist ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $film = $result->fetch_assoc();
            echo "<h1>Film consigliato " . $film['titolo'] . "</h1>";
        }else{
            echo "<h1>Lista film vuota</h1>";
        }

        echo "<br><h2>Inserisci il titolo e/o il regista del film che vuoi cercare</h2>";

        ?>

        <form method="post">
            Titolo: <input name="titolo" type="text"/>
            Regista: <input name="regista" type="text"/>
            <input type="submit" value="search" name="action"/>
        </form>
        <?php


        echo "<br><h2>Premi per vedere la tua wlist</h2>";
        ?>
        <form method="post">
        <input type="submit" name="action" value="wlist"/>
        </form>
        <?php

    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $action = $_POST['action'];

        switch($action){
            case 'search': {
                $titolo = $_POST['titolo'];
                $regista = $_POST['regista'];
                if($titolo == "" AND $regista == ""){
                    echo "<h3>Uno dei due campi deve essere riempito</h3>";
                    echo "<a href='index.php'><h3>Ritorna alla home</h3></a>";
                }else{
                    $sql = "SELECT * FROM flist WHERE titolo=? OR regista=?";
                    $stm = $conn->prepare($sql);
                    $stm->bind_param("ss", $titolo, $regista);
                    if($stm->execute()){
                        $result = $stm->get_result();
                        if($result->num_rows > 0){
                            $films = $result->fetch_all(MYSQLI_ASSOC);
                            echo "<ul>";
                            foreach($films as $film){
                                echo "<li>";
                                echo "<h3>Titolo: " . $film['titolo'] ."</h3>";
                                echo "<h3>Regista: " . $film['regista']. "</h3>";
                            }
                            echo "</ul>";
                        }else{
                            if($titolo != "" AND $regista != ""){
                                echo "<h2>Vuoi inserire questo film nella wlist?</h2>";
                                ?>
                                <form method="post">
                                <input name="titolo" type="text" hidden value="<?= $titolo ?>" />
                                <input name="regista" type="text" hidden value="<?= $regista ?>" />
                                <input type="submit" value="si" name="action"/>
                                <input type="submit" value="no" name="action"/>
                                </form>
                                <?php
                            }else{
                                echo "<h2>Nessun film trovato con questi valori</h2>";
                                echo "<a href='index.php'><h3>Ritorna alla home</h3></a>";
                            }   
                        }
                    }
                }

            }break;
            
            case 'no' : {
                header("Location: index.php");
            }break;
            case 'si' : {
                $titolo = $_POST['titolo'];
                $regista = $_POST['regista'];
                $sql = "INSERT INTO wlist (titolo, regista) VALUES(?,?)";
                $stm = $conn->prepare($sql);
                $stm->bind_param("ss", $titolo, $regista);

                if($stm->execute()){
                    echo "<h2>Film aggiunto con successo</h2>";
                    echo "<a href='index.php'><h3>Ritorna alla home</h3></a>";
                }
            }break;

            case 'wlist' : {
                $sql = "SELECT * from wlist";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $films = $result->fetch_all(MYSQLI_ASSOC);
                    echo "<ul>";
                    foreach($films as $film){
                        echo "<li>";
                        echo "<h3>Titolo: " . $film['titolo'] ."</h3>";
                        echo "<h3>Regista: " . $film['regista']. "</h3>";
                    }
                    echo "</ul>";

                    ?>
                    <form method="post">
                    <input type="submit" name="action" value="svuota">
                    </form>
                    <?php
                }else{
                    echo "<h1>Wlist vuota</h1>";
                }

                echo "<a href='index.php'><h4>Torna alla home</h4></a>";
            }break;

            case 'svuota' : {
                $sql = "TRUNCATE wlist";
                $conn->query($sql);
                echo "<h2>WLIST pulita</h2>";
                echo "<a href='index.php'><h4>Torna alla home</h4></a>";
            }
            
            
        }
    }

    


    $conn->close();
?>
</body>
</html>