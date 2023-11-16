<html>
  <head>
    <title>Create</title>
</head>
  <body>
    <?php
    require_once('json_fake_db.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $id = $_POST['id'];
      $title = $_POST['title'];
      $year = $_POST['year'];
      $country = $_POST['country'];
      $film_maker = $_POST['film_maker'];
      $link = $_POST['link'];

      if($title != "" && $year != "" && $country != "" && $film_maker != ""){
        $data = array('title'=>$title, 'year'=>$year, 'country'=>$country, 'film_maker'=>$film_maker, 'link'=>$link);
        CreateFilm($id, $data);
      }else{
        ?>
          <script type="text/javascript">
            alert("Please insert title, year, country and film maker");
          </script>
        <?php
      }

    }else{
      $GLOBALS['new_id'] = uniqid();
      ?>
      <center>
      <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" id="id" name="id" value="<?php print $GLOBALS['new_id']; ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" required /><br />

        <label for="year">Year:</label>
        <input type="text" name="year" required /><br />

        <label for="country">Country:</label>
        <input type="text" name="country" required /><br />

        <label for="film_maker">Film Maker:</label>
        <input type="text" name="film_maker" required /><br />

        <label for="link">Link:</label>
        <input type="url" name="link" required /><br />

        <input type="submit" value="Submit" />
      </form>
      </center>
      <?php
    }
    ?>
    <a href = "index.html">Come back to home page</a>
  </body>
</html>