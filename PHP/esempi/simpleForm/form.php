<html>
  <head>
    <title>Welcome into my forum</title>
</head>
<body>
  <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if($username == "" && $email== "" && $password==""){
        ?>
        <br><br>
        <?php
        print 'Please fill all the fields';
      }else{

      ?>
      <center>
      <p>Riepilogo dati inseriti<p>
        Username: <input readonly value="<?php print $username; ?>"><br><br>
        Email: <input readonly value="<?php print $email; ?>"><br><br>
        Password: <input readonly value="<?php print $password; ?>"><br><br>
    </center>
    
      <?php
      }
    }else{
      ?>
      <center>

      <form method="post" action="processor.php">
        Username: <input name="username" required type="text" /><br /><br />
        Email: <input name="email" required type="text" /><br /><br />
        Password: <input name="password" required type="text" /><br /><br />
        <input type="submit" name="Submit" value="Submit"/>
      </form>
    </center>
      <?php
    }
    
  ?>
  </body>
</html>
