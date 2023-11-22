<?php
  function getConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "giovanni";
    $dbname = "php_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
      die("Connessione al database fallita " . $conn->connect_error);
    }

    return $conn;

  }

  function createTable() {
    $conn = getConnection();

    if ($conn->connect_error) {
        die("Connessione al database fallita " . $conn->connect_error);
    }

    $sql = "CREATE TABLE IF NOT EXISTS Books (
      id INT AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(255) NOT NULL,
      author VARCHAR(255) NOT NULL,
      year INT NOT NULL
    )";

    $stm = $conn -> prepare($sql); 

    if ($stm->execute()) {
        error_log("Tabella creata con successo o già esistente.");
    } else {
        error_log("Errore nella creazione della tabella: " . $conn->error);
    }

    $conn->close();
  }


  function getAllBooks(){

    $conn = getConnection();

    $sql = "SELECT * FROM Books";

    $stm = $conn->prepare($sql);

    $stm->execute();

    $books = array();

    if($result = $stm->get_result()){
      $books = $result->fetch_all(MYSQLI_ASSOC);
    }
    
    $conn->close();
    $stm->close();
    return $books;
  }

  function createBook($data){

    $conn = getConnection();

    $sql = "INSERT INTO Books (title, author, year) VALUES(?,?,?)";

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

    $conn = getConnection();


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
    $conn = getConnection();
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