<html>
  <head>
  <title>List</title>
</head>
<body>
<center>

  <?php
    require_once("database.php");

    $studenti = getStudenti();
    if(empty($studenti)){
      ?>
      <h1>Il registro è vuoto</h1>
      <?php
    }else{
      ?>
      <h1>Elenco studenti</h1><br>
      <?php
    foreach($studenti as $studente){

      ?>
      <p>
    <form>
    Nome: <input readonliny value="<?php print $studente['nome']; ?>">
    Cognome: <input readonliny value="<?php print $studente['cognome']; ?>">
    Età: <input readonliny value="<?php print $studente['età']; ?>">
    </form>
    </p>
      <?php
    }
  }
  ?>
</center>
<p><a href="index.php">Torna alla home page</a></p>

  </body>
  </html>
  