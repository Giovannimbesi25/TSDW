<html>
  <head>
    <title>Book Store</title>
</head>
<body>
  <center>
  <h1>About page</h2>
  <?php
    require_once("database.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $isbn = $_POST['isbn'];
      $book = getBookInfo($isbn);
      switch($_POST['mode']){



        case 'update':{
          $data = array('isbn' => $_POST['isbn'],
          'title' => $_POST['title'],
          'author' => $_POST['author'],
          'ranking' => $_POST['ranking'],
          'year' => $_POST['year'],
          'price' => $_POST['price']);

          if(updateBook($data)){
            echo "<h2>Book updated successfully</h2>";
            $book = getBookInfo($isbn);

          }else{
            echo "<h2>Failed book update";
          }
          break;
        }
        

        case 'delete': {
          $isbn = $_POST['isbn'];
          if(deleteBook($isbn)){
            header("Location: detail.php");

          }else{
            echo "<h2>Error deleting book</h2>";
          }
          break;
        }



      }
    }
      if($book){
        ?>
          <form method = "post" action = "<?= $_SERVER['PHP_SELF'] ?>">
          ISBN: <input readonly type="text" name="isbn" value="<?= $book['isbn'] ?>"><br><br>
          TITLE: <input  type="text" name = "title" value="<?= $book['title'] ?>"><br><br>
          AUTHOR: <input  type="text" name = "author" value="<?= $book['author'] ?>"><br><br>
          Ranking: <input type="text" name = "ranking" value="<?= $book['ranking'] ?>"><br><br>
          YEAR: <input type="text" name = "year" value="<?= $book['year'] ?>"><br><br>
          PRICE: <input type="text" name = "price" value="<?= $book['price'] ?>"><br><br>
          <input value = "update" type="submit" name="mode">
          <input value = "delete" type="submit" name="mode">
          </form>

        <?php
      }else{
        echo "<h2>Book deleted successfully</h2>";
        ?>
        <a href="index.php">Go back to home page</a>

        <?php
      }
      ?>
    
</center>
</body>









