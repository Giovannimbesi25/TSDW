<?php

  function getConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "giovanni";
    $dbName = "php_db";

    $conn = new mysqli($servername, $username, $password, $dbName) or die("Connect failed " .$conn->error);

    return $conn;
  }

  function createTable(){
    $conn = getConnection();

    $sql = "CREATE TABLE IF NOT EXISTS books (
      isbn VARCHAR(30) PRIMARY KEY NOT NULL,
      title VARCHAR(30) NOT NULL,
      author VARCHAR(30) NOT NULL,
      rankinging VARCHAR(30) NOT NULL,
      year VARCHAR(30) NOT NULL,
      price VARCHAR(30) NOT NULL
    )";

    if($conn->query($sql) == TRUE){
      echo 'Table created successfully';
    }else{
      echo 'Error creating table';
    }

    $conn->close();
  }

  function getAllBooks(){
    $conn = getConnection();

    $sql = "SELECT * FROM books";

    if($result = $conn->query($sql)){
      $conn->close();
      return $result->fetch_all(MYSQLI_ASSOC);
      
    }else{

      $conn->close();
      die('Error getting books');
    }

  }


  function addBook($data){
    $conn = getConnection();

    $sql = "INSERT INTO books (isbn, title, author, ranking, year, price)
    VALUES(?,?,?,?,?,?)";

    $stm = $conn->prepare($sql);

    $stm->bind_param("ssssss", $data['isbn'], $data['title'], $data['author'], $data['ranking'], $data['year'], $data['price']);

    if($stm->execute()){

      $stm->close();
      $conn->close();
      return true;
    }else{
      $stm->close();
      $conn->close();

      return false;
    }
  }


  function updateBook($data){
    $conn = getConnection();

    $sql = "UPDATE books SET title = ? , author = ?, ranking = ?, year = ?, price = ? WHERE isbn = ?";

    $stm = $conn->prepare($sql);

    $stm->bind_param("ssssss", $data['title'], $data['author'], $data['ranking'], $data['year'], $data['price'], $data['isbn']);

    if($stm->execute()){

      $stm->close();
      $conn->close();
      return true;
    }else{
      $stm->close();
      $conn->close();

      return false;
    }
  }

  function deleteBook($isbn){
    $conn = getConnection();

    $sql = "DELETE FROM books WHERE isbn = ? ";

    $stm = $conn->prepare($sql);

    $stm->bind_param("s", $isbn);

    if($stm->execute()){

      $stm->close();
      $conn->close();
      return true;
    }else{
      $stm->close();
      $conn->close();

      return false;
    }
  }

  function getBookInfo($isbn){
    $conn = getConnection();

    $sql ="SELECT * FROM books Where isbn = ?";

    $stm = $conn->prepare($sql);

    $stm->bind_param("s", $isbn);

    if($stm->execute()){
      $data = $stm->get_result()->fetch_assoc();

    
      $stm->close();
      $conn->close();
      return $data;
    }else{
      $stm->close();
      $conn->close();

      return false;
    }
    
  }



?>