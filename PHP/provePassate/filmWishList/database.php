<?php

  function getConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "giovanni";
    $dbName = "php_db";

    $conn = new mysqli($servername, $username, $password, $dbName) or die("Connection not established..."); 

    return $conn;
  }

  function createTables(){
    $conn = getConnection();

    $sql_flist = "CREATE TABLE IF NOT EXISTS flist(
      titolo VARCHAR(30) NOT NULL,
      regista VARCHAR(30) NOT NULL
    )";

    if($conn->query($sql_flist)){
      echo "Table flist created successfully";
    }

    $sql_insert = "INSERT INTO `flist` VALUES ('Blade Runner','Ridley Scott'),('I predatori dell\'arca perduta','Steven Spielberg'),('Star Wars','George Lucas'),('Ritorno al futuro','Robert Zemeckis'),('Frankenstein Junior','Mel Brooks'),('Alien','Ridley Scott'),('The Goonies','Richard Donner'),('Il senso della vita','Terry Jones - Terry Gilliam');";

    if($conn->query($sql_insert)){
      echo "Table flist filled successfully";
    }

    $sql_wlist = "CREATE TABLE IF NOT EXISTS wlist(
      titolo VARCHAR(30) NOT NULL,
      regista VARCHAR(30) NOT NULL
    )";

    if($conn->query($sql_wlist)){
      echo "Table wlist created successfully";
    }

    $conn->close();
  }

  function getRandomFilmTitle(){

    $conn = getConnection();

    $sql = "SELECT * FROM flist ORDER BY RAND() LIMIT 1";

    if($result = $conn->query($sql)){
      $data = $result->fetch_assoc();
    }

    $conn->close();

    return $data['titolo'];
  }

  function searchFilms($titolo, $regista){
    $conn = getConnection();

    $sql = "SELECT * FROM flist WHERE titolo = ? OR regista = ?";

    $stm = $conn->prepare($sql);

    $stm->bind_param("ss", $titolo, $regista);

    $stm->execute();

    if($result = $stm->get_result()){
      $data = $result->fetch_all(MYSQLI_ASSOC);

    }

    $stm->close();
    $conn->close();

    return $data;
  }

  function insertFilm($titolo, $regista){
    $conn = getConnection();

    $sql = "INSERT INTO wlist (titolo, regista) VALUES(?,?)";

    $stm = $conn->prepare($sql);

    $stm->bind_param("ss", $titolo, $regista);

    

    if($stm->execute() == TRUE){
      $stm->close();
      $conn->close();

      return true;
    }else{
      $stm->close();
      $conn->close();
      return false; 
    }


  }


  function getWlist(){
    $conn = getConnection();

    $sql = "SELECT * FROM wlist";

    if($result = $conn->query($sql)){
      $data = $result->fetch_all(MYSQLI_ASSOC);

    }

    $conn->close();

    return $data;
  }

  function truncateWlist(){
    $conn = getConnection();

    $sql = "TRUNCATE TABLE wlist";

    $conn->query($sql);

    $conn->close();
  }

?>