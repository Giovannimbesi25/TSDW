<html>
  <body>
    <center>
      <h1>Questi sono i libri disponibili</h1>
      <?php

        require_once('database.php');

        $books = getAllBooks();

        if(empty($books)){
          echo "La libreria è vuota";
        }else{
          foreach($books as $row){
            ?>
            Title: <input value="<?php print $row['title']; ?>" readonly>
            Author: <input value="<?php print $row['author']; ?>" readonly>
            Year: <input value="<?php print $row['year']; ?>" readonly>
            <br><br>
            <?php
          }
        }
      ?>
     </center>
     <a href="index.php">Torna alla home page</a>
  </body>
</html>