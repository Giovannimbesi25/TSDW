<html>
<head>
    <title>Film Wish List</title>
</head>
<body>
  <center>
  <?php
    require_once('database.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      truncateWlist();

      ?>

      <h1>Wlist svuotata</h1>

      <h3>
          <a href="index.php">Ritorna alla home</a>
          </h3>
      <?php
    }else{
  ?> 


    <h1>Questa è la tua wlist</h1><br><br>

    
    <?php
      $wlist = getWlist();

      foreach($wlist as $row){
        ?>
        <p>
          <h2>Titolo: <?= $row['titolo']?> </h2>
          <h2>Regista:  <?= $row['regista'] ?> </h2><br><br>
        </p>
          <?php
      }
    ?>

    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input type="submit" value="Svuota Wlist">
    </form>
    <?php
  }?>
</center>
</body>
</html>