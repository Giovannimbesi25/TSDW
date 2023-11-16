<?php
class Account {
  private $username;
  private $password;
  private $utente;

  function __construct($username, $password, $utente){
    $this->username = $username;
    $this->password = $password;
    $this->utente = $utente;
  }

  function getUsername(){
    return $this->username;
  }

  function getPassword(){
    return $this->password;
  }

  function getProprietario(){
    return $this->utente;
  }

  function setUsername($username){
    $this->username = $username;
  }

  function setPassword($password){
    $this->password = $password;
  }

  function setProprietario($utente){
    $this->utente = $utente;
  }
}
?>
