<html>
<head>
    <title>Film Wish List</title>
  </head>
  <body>
  <center>
  <?php
    require_once('database.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $titolo = $_POST['titolo'];
      $regista = $_POST['regista'];

      if (isset($_POST['choice'])) {
        $choice = $_POST['choice'];

        if ($choice == "Si") {
            if (insertFilm($titolo, $regista)) {
                echo "<h2>Film inserito nella wlist</h2><br>";
            } else {
                echo "<h2>ERRORE: Film non inserito nella wlist</h2><br>";
            }
            ?>
            <h3>
            <a href="index.php">Ritorna alla home</a>
            </h3>
            <?php
        } elseif ($choice == "No") {
            header("Location: index.php");
        }
      }else if(!empty($data = searchFilms($titolo, $regista))){
        ?>
          <h1>Questi sono il/i film richiesto/i:</h1><br>
        <?php
        foreach($data as $row){
          ?>
          <h1>Titolo: <?= $row['titolo']?> </h1>
          <h1>Regista:  <?= $row['regista'] ?> </h1><br><br>
  
          <?php
        }
        
        ?>
        <h3>
          <a href="index.php">Ritorna alla home</a>
        </h3>
        <?php

      }else{
        ?>
          <h2>Non ci sono film con questo titolo, vuoi inserirlo?</h2><br>
          <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
              <input type="hidden" name="titolo" value="<?= $titolo ?>"/>
              <input type="hidden" name="regista" value="<?= $regista ?>" />
              <input type="submit" name="choice" value="Si"/>
              <input type="submit" name="choice" value="No"/>
          </form>

        <?php
      }

    }else{  
    ?>
      <h1>Cerca un film</h1><br><br>

      
      <h2>Inserisci titolo e regista</h2><br>

      <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      Titolo: <input type="text" name = "titolo" value="" />
      Regista: <input type="text" name = "regista" value="" />
      <input type="submit" value="Cerca"/>
    </form>
    <?php
  }
  ?>
</center>
</body>

