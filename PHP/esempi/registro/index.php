<html>
  <?php
    require_once('database.php');
    
    createTable();
  ?>
  <head>
    <title>Registro Studenti</title>
  </head>
  <body>
    <center>
    <h1>Benvenuto nel registro studenti</h1>
    <h2>Cosa vuoi fare?</h2>
    <h3>
  <li>
    <a href="list.php">Lista Studenti</a>
  </li></h3>
  <h3><li>
    <a href="insert.php">Inserisci nuovo studente</a>
  </li> </h3> 
  <h3><li>
    <a href="update.php">Modifica profilo studente</a>
  </li></h3>  
  <h3><li>
    <a href="delete.php">Elimina profilo studente</a>
  </li>
  </h3>
</center>
</body>
</html>