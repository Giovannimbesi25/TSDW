<html>
  <head>
    <title>Delete Film</title>
</head>
<body>
  <?php
    require_once('json_fake_db.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      DeleteFilm($id);
      print 'Record deleted successfully';
    }else{
      $array = ReadAllFilms();

      foreach($array as $film => $data){
        ?>
        <center>
          <form method="post" action = "<?php print $_SERVER['PHP_SELF']; ?>" >
          <input type="hidden" name="id" value="<?php print $film; ?>">
          Title: <input type="text" name ="title" value = "<?php print $data['title']; ?> ">
          Year: <input type="text" name ="year" value = "<?php print $data['year']; ?> ">
          Country: <input type="text" name ="country" value = "<?php print $data['country']; ?> ">
          Film Maker: <input type="text" name ="film_maker" value = "<?php print $data['film_maker']; ?> ">
          Link: <input type="link" name ="link" value = "<?php print $data['link']; ?> ">
          <input type = "submit"  value = "Delete">
      </form>
      </center>
        </center>
        <?php
      }
    }
    ?>
    <br>
    <a href = "index.html">Come back to home page</a>
  </body>
</html>


