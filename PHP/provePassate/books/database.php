<?php

function getConnection (){
    return $conn = new mysqli("localhost", "root", "giovanni", "php_db");
}

function addBook($isbn, $title, $author, $ranking, $year, $price){
    $conn = getConnection();
    $sql = "INSERT INTO books(isbn, title, author, ranking, year, price) VALUES (?,?,?,?,?,?)";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ssssss", $isbn, $title, $author, $ranking, $year, $price);

    if($stm->execute()){
        $conn->close();
        $stm->close();

        return true;
    }else{
        
        $conn->close();
        $stm->close();

        return false;
    }
}

function getAll(){
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

function getBook($isbn){
  $conn = getConnection();
  $sql = "SELECT * FROM books WHERE isbn = ?";
  $stm = $conn->prepare($sql);
  $stm->bind_param("s", $isbn);
  
  if($stm->execute()){
    $data = $stm->get_result()->fetch_assoc();
    $stm->close();
    $conn->close();

    return $data;
  }
}

function deleteBook($isbn){
  $conn = getConnection();
  $sql = "DELETE FROM books WHERE isbn = ?";
  $stm = $conn->prepare($sql);
  $stm->bind_param("s", $isbn);

  if($stm->execute()){
    $conn->close();
    $stm->close();

    return true;
  }else{
      
      $conn->close();
      $stm->close();

      return false;
  }
}

function updateBook($isbn, $title, $author, $ranking, $year, $price){
  $conn = getConnection();
  $sql = "UPDATE books SET title=?, author=?, ranking=?, year=?, price=? WHERE isbn=?";
  $stm = $conn->prepare($sql);
  $stm->bind_param("ssssss", $title, $author, $ranking, $year, $price, $isbn);

  if($stm->execute()){
      $conn->close();
      $stm->close();

      return true;
  }else{
      
      $conn->close();
      $stm->close();

      return false;
  }
}

?>