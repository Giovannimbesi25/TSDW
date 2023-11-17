<html>
  <body>
    <center>
      <h1>Modifica un libro</h1>
      <?php

        require_once('database.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $id = $_POST['id'];
          $author = $_POST['author'];
          $title = $_POST['title'];
          $year = $_POST['year'];
          if($title!="" && $author!="" && $year!=""){
            $data = array('id'=>$id, 'title'=>$title, 'author'=>$author, 'year'=>$year);
            updateLibro($data);
          }else{
            echo 'Please fill all the fields';
          }
        }else{
          $books = getAllBooks();

          foreach($books as $row){
            ?>
            <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <input type="hidden" name="id" value="<?php print $row['id']; ?>">
            Title: <input name="title" value="<?php print $row['title']; ?>" >
            Author: <input name="author" value="<?php print $row['author']; ?>" >
            Year: <input name="year" value="<?php print $row['year']; ?>" >
            <input value="Modifica" type="submit">
            </form>
            <?php
          }
        }
      ?>
     </center>
     <br>
     <a href="index.php">Torna alla home page>
  </body>
</html>