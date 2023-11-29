<html>
  <head>
  <title>Update</title>
</head>
<body>
<center>

  <h1>Modifica profilo studente</h1>

  <?php
    require_once("database.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $id = $_POST['id'];
      $nome = $_POST['nome'];
      $cognome = $_POST['cognome'];
      $eta = $_POST['età'];
      $data = ['id'=>$id, 'nome'=>$nome, 'cognome'=>$cognome, 'età'=>$eta];
      if(updateStudente($data)){
        ?>
        <h3>Studente modificato con successo</h3>
        <?php
      }else{
        ?>
        <h3>ERRORE: Studente non modificato</h3>
        <?php
      }

    }else{
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
    
      <form method="post" action="">
      <input  type="hidden" name="id" value="<?php print $studente['id']; ?>">
      Nome: <input name="nome" value="<?php print $studente['nome']; ?>">
      Cognome: <input name="cognome" value="<?php print $studente['cognome']; ?>">
      Età: <input  name="età" value="<?php print $studente['età']; ?>">
      <input type="submit" value="Modifica"><br><br>
      </form>
      </p>
        <?php
    }
  }
}
  ?>
</center>
<p><a href="index.php">Torna alla home page</a></p>

  </body>
  </html>
  