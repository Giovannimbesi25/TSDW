<html>
  <head>
    <title>Read All Films</title>
</head>
<body>
  <?php

  require_once('json_fake_db.php');
  $array = ReadAllFilms();
  if($array){
    foreach($array as $film => $data){
      ?>
      <center>
        <form action = "<?php print $_SERVER['PHP_SELF']; ?>" method = "post">
          <input type="hidden" name="id" value="<?php print $film; ?>">
          Title: <input type="text" name="title" value="<?php print $data['title']; ?>" readonly>
          Year: <input type="text" name="year" value="<?php print $data['year']; ?>" readonly>
          Country: <input type="text" name="country" value="<?php print $data['country']; ?>" readonly>
          Film Maker: <input type="text" name="film_maker" value="<?php print $data['film_maker']; ?>" readonly>
          Link: <a href = "<?php print $data['link']; ?>"><?php print $data['link']; ?></a>
        </form>
      </center>
      
      <?php
    }
  }
  ?>
  <a href = "index.html">Come back to home page> 
</body>
</html>