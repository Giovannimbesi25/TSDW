<?php
class Utente{
  private $nome;
  private $cognome;
  private $nickname;
  private $email;

  function __construct($nome, $cognome, $nickname, $email){
    $this->nome = $nome;
    $this->cognome = $cognome;
    $this->nickname = $nickname;
    $this->email = $email;
  }

  function getNome(){
    return $this->nome;
  }

  function getCognome(){
    return $this->cognome;
  }

  function getNickname(){
    return $this->nickname;
  }

  function getEmail(){
    return $this->email;
  }

  function setNome($nome){
    $this->nome = $nome;
  }

  function setCognome($cognome){
    $this->cognome = $cognome;
  }

  function setNickname($nickname){
    $this->nickname = $nickname;
  }

  function setEmail($email){
    $this->email = $email;
  }
}
?>
