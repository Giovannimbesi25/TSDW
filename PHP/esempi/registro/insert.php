<html>
  <head>
  <title>Insert</title>
</head>
<body>
<center>

  <h1>Inserisci un nuovo studente</h1>

  <?php
    require_once("database.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $nome = $_POST['nome'];
      $cognome = $_POST['cognome'];
      $eta = $_POST['età'];
      $data = ['nome'=>$nome, 'cognome'=>$cognome, 'età'=>$eta];
      if(insertStudente($data)){
        ?>
        <h3>Studente inserito con successo</h3>
        <?php
      }else{
        ?>
        <h3>ERRORE: Studente non inserito</h3>
        <?php
      }

    }else{
      ?>
      <h3>Inserisci i dati del tuo nuovo studente</h3>
      <form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
      Nome:    <input type="text" name="nome"  value=""><br><br>
      Cognome: <input type="text" name="cognome" value=""><br><br>
      Età:     <input type="number" name="età" value=""><br><br>
      <input type="submit" value="Submit"><br><br>
      </form>
        <?php
    }
  ?>
</center>
<p><a href="index.php">Torna alla home page</a></p>

  </body>
  </html>
  