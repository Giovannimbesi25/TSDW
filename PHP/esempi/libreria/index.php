<html>
  <head>
    <title>Libreria</title>
  </head>
<body>
  <?php
    require_once('database.php');
    createTable();
  ?>
<center>
<h1>Benvenuto nella mia libreria</h1><br>
  <h2>Cosa vuoi fare?</h2>
  <li>
    <a href="list.php">Lista libri</a>
  </li>
  <li>
    <a href="create.php">Inserisci un nuovo libro</a>
  </li>
  <li>
    <a href="update.php">Modifica un libro</a>
  </li>
  <li>
    <a href="delete.php">Elimina un libro</a>
  </li>
</center>
</body>
</html>