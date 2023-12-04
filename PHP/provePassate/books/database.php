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

?>