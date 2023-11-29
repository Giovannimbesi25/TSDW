<html>
  <head>
    <title>Book Store</title>
</head>
<body>
  <center>
  <h1>Welcome into the book store</h2>
  <h2>These are our books</h2><br><br>
<?php
  require_once("database.php");

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = array('isbn' => $_POST['isbn'],
                  'title' => $_POST['title'],
                  'author' => $_POST['author'],
                  'ranking' => $_POST['ranking'],
                  'year' => $_POST['year'],
                  'price' => $_POST['price']);
                
    if(addBook($data)){
      ?>
      <h2>Book added successfully</h2>
      <?php
    }
  }


  $books = getAllBooks();
?>


  <?php

    if(!empty($books)){
      foreach($books as $book){
        ?>
        <form method = "post" action = "detail.php">
        ISBN: <input readonly type="text" name="isbn" value="<?= $book['isbn'] ?>">
        TITLE: <input readonly type="text" name = "title" value="<?= $book['title'] ?>">
        AUTHOR: <input  readonly type="text" name = "author" value="<?= $book['author'] ?>">
        <input value = "detail" type="submit">
        </form>
        <br>
        <?php
      }
    }else{
      echo "<h2>Attualmente la libreria è vuota</h2>";
    }

    ?>
    <br><br><br><br><h2>Vuoi aggiungere un nuovo libro?</h2><br><br>
    <form method = "post" action = "">
        ISBN: <input type="text" name="isbn" value=""><br><br>
        TITLE: <input type="text" name = "title" value=""><br><br>
        AUTHOR: <input type="text" name = "author" value=""><br><br>
        Ranking: <input type="text" name = "ranking" value=""><br><br>
        YEAR: <input type="text" name = "year" value=""><br><br>
        PRICE: <input type="text" name = "price" value="">
        <input value = "Aggiungi" type="submit">
    </form>

</center>
</body>


