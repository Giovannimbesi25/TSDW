<html>
  <head>
  <title>Delete</title>
</head>
<body>
  <script>
    function confermaDelete(){
      return confirm("Sei sicuro di voler eliminare questo profilo?");
    }
    </script>
<center>

  <h1>Elimina profilo studente</h1>

  <?php
    require_once("database.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $id = $_POST['id'];
      if(deleteStudente($id)){
        ?>
        <h3>Studente eliminato con successo</h3>
        <?php
      }else{
        ?>
        <h3>ERRORE: Studente non eliminato</h3>
        <?php
      }
      ?>
      <?php
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
    
      <form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" onsubmit="return confermaDelete()" >
      <input  type="hidden" name="id" value="<?php print $studente['id']; ?>">
      Nome: <input name="nome" value="<?php print $studente['nome']; ?>" readonly>
      Cognome: <input name="cognome" value="<?php print $studente['cognome']; ?>"readonly>
      Età: <input  name="età" value="<?php print $studente['età']; ?>"readonly>
      <input type="submit" value="Elimina"><br><br>
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
  