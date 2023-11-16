<html>
  <head>
    <title>Update Film</title>
</head>
<body>
  <?php

    require_once('json_fake_db.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $id = $_POST['id'];
      $title = $_POST['title'];
      $year = $_POST['year'];
      $country = $_POST['country'];
      $film_maker = $_POST['film_maker'];
      $link = $_POST['link'];

      if($title != "" && $year != "" && $country != "" && $film_maker != "" &&
      $link != ""){
        $data = array('title'=>$title, 'year'=>$year, 'country'=>$country
        ,'film_maker'=>$film_maker , 'link'=>$link);
        UpdateFilm($id, $data);
        print 'Record mofified successfully';
      }else{
        print 'Please fill all the fields!';
      }
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
          <input type = "submit" name="modify" value = "Modify">
      </form>
      </center>
        <?php
      }
    }
  ?>
  <br>
  <a href = "index.html">Go back to home page</a>
  </body>
  </html>