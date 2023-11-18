<?php
  $servername = "localhost";
  $username = "root";
  $password = "giovanni";
  $dbname = "php_db";

  function createTable() {
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione al database fallita " . $conn->connect_error);
    }

    $sql = "CREATE TABLE IF NOT EXISTS Books (
      id INT AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(255) NOT NULL,
      author VARCHAR(255) NOT NULL,
      year INT NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        error_log("Tabella creata con successo o già esistente.");
    } else {
        error_log("Errore nella creazione della tabella: " . $conn->error);
    }

    $conn->close();
  }


  function getAllBooks(){

    global $username, $password, $dbname, $servername;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
      die("Connessione al database fallita " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Books";
    $result = $conn->query($sql);
    $books = array();

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $books[] = $row;
      }
    }

    $conn->close();

    return $books;
  }

  function createBook($data){

    error_log("CREATE BOOK");

    global $username, $password, $dbname, $servername;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
      die("Connessione al database fallita " . $conn->connect_error);
    }

<<<<<<< HEAD
    $sql = "INSERT INTO Books (title, author, year) VALUES(?,?,?)";
=======
    $sql = "INSERT INTO Books (title, author, year) VALUES(?,?,?,?)";
>>>>>>> 7da3c3cb8ec695a18bc1dd381de78677c0d3d34e

    $stm = $conn->prepare($sql);
    $stm->bind_param("sss", $data['title'], $data['author'], $data['year']);
    
    if($stm->execute()){
      echo "Libro inserito con successo";
    }else{
      echo "Insert Failed";
    }

    $stm->close();
    $conn->close();

  }

  function deleteBook($id){

    global $username, $servername, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
      die("Connessione al database fallita " . $conn->connect_error);
    }

    $sql = "DELETE FROM Books WHERE id = ?";

    $stm = $conn->prepare($sql);
    $stm->bind_param("i", $id);

    if($stm->execute()){
      echo "Libro eliminato con successo";?><br><br><?php
    }else{
      echo "Delete Failed";
    }

    $stm->close();
    $conn->close();
  }

  function updateLibro($data){
    global $servername , $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
      die("Errore nella connessione " . $conn->connect_error);
    }

    $sql = "UPDATE Books SET title = ? , author = ? , year = ? WHERE id = ? ";
    $stm = $conn->prepare($sql);

    $stm->bind_param("sssi", $data['title'], $data['author'], $data['year'], $data['id']);

    if($stm->execute()){
      echo "Libro modificato con successo";
    }else{
      echo "Update Failed";
    }

    $stm->close();
    $conn->close();
  }



?>