<?php

function getConnection (){
  $servername = "localhost";
  $username = "root";
  $password = "giovanni";
  $dbName = "php_db";

  $conn = new mysqli($servername, $username, $password, $dbName) or die("Connection not established...");

  return $conn;
}

function createTable(){
  $conn = getConnection();

  $sql = "CREATE TABLE IF NOT EXISTS Studenti(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(20) NOT NULL,
    cognome VARCHAR(20) NOT NULL,
    età INT(6) NOT NULL
    )";
  

  if($conn->query($sql)){
    echo "Table created successfully";
  }else{
    echo "Error creating table...";
  }
  $conn->close();
}

function insertStudente($data){

  $conn = getConnection();

  $sql = "INSERT INTO Studenti (nome, cognome, età) VALUES (?,?,?)";

  $stm = $conn->prepare($sql);

  $stm->bind_param("ssi", $data['nome'], $data['cognome'], $data['età']);

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

function getStudenti(){
  $conn = getConnection();

  $sql = "SELECT * FROM Studenti";


  if($result = $conn->query($sql)){

    $studenti = $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    $stm->close();

    return $studenti;
  }else{
    $conn->close();
    $stm->close();

    return false;
  }
}

function updateStudente($data){
  $conn = getConnection();

  $sql = "UPDATE Studenti SET nome=? , cognome=?,  età=? WHERE id = ? ";

  $stm = $conn->prepare($sql);

  $stm->bind_param("ssii", $data['nome'], $data['cognome'], $data['età'], $data['id']);

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



function deleteStudente($id){
  $conn = getConnection();

  $sql = "DELETE FROM Studenti WHERE id = ?";

  $stm = $conn->prepare($sql);

  $stm->bind_param("i", $id);

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