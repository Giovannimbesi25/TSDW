<html>
  <body>
    <center>
      <h1>Crea un nuovo libro</h1>
      <?php

        require_once('database.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $author = $_POST['author'];
          $title = $_POST['title'];
          $year = $_POST['year'];
          if($title!="" && $author!="" && $year!=""){
            $data = array('title'=>$title, 'author'=>$author, 'year'=>$year);
            createBook($data);
          }else{
            echo 'Please fill all the fields';
          }
        }else{
          ?>
          <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
          Title: <input type="text" name="title" value="">
          Author: <input type="text" name="author" value="" >
          Year: <input type="text" name="year" value="" >
          <input value="Submit" type="submit">
          </form>
          <?php
        }
      ?>
     </center>
     <br>
     <a href="index.php">Torna alla home page>
  </body>
</html>