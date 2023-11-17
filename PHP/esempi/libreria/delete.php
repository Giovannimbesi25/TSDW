<html>
  <body>
    <center>
      <h1>Scegli il libro da rimuovere</h1>
      <?php

        require_once('database.php');

        if($_SERVER['REQUEST_METHOD']=='POST'){
          $id = $_POST['id'];
          deleteBook($id);
        }

        $books = getAllBooks();

        if(empty($books)){
          echo "La libreria è vuota";
        }else{
          foreach($books as $row){
            ?>
            <form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php print $row['id']; ?>">
            Title: <input value="<?php print $row['title']; ?>" readonly>
            Author: <input value="<?php print $row['author']; ?>" readonly>
            Year: <input value="<?php print $row['year']; ?>" readonly>
            <input type="submit" value="Delete">
            </form>
            <?php
          }
        }
      ?>
     </center>
     <a href="index.php">Torna alla home page</a>
  </body>
</html>