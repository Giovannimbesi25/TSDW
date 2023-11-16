<?php
$GLOBALS['FileName'] = "JSONFAKEDB.txt";
$GLOBALS['ArrayFakeDB'] = array();

function LoadFromJson(){
  if($file = @fopen($GLOBALS['FileName'], "r")){
    $GLOBALS['ArrayFakeDB'] = json_decode(fread($file, filesize($GLOBALS['FileName'])), true);
    fclose($file);
    return true;
  }else{
    return false;
  }
}

function SaveToJson(){
  if($file = fopen($GLOBALS['FileName'], "w")){
    $s = json_encode($GLOBALS['ArrayFakeDB']);

    if(fwrite($file, $s)){
      fclose($file);
      return true;
    }else{
      fclose($file);
      return false;
    }
  }else{
    return false;
  }
}

  function CreateFilm($id, $data){
    LoadFromJson();
    $array = $GLOBALS['ArrayFakeDB'];
    $array[$id] = $data;
    $GLOBALS['ArrayFakeDB'] = $array;
    SaveToJson();
  }

  function ReadAllFilms(){
    LoadFromJson();
    return $GLOBALS['ArrayFakeDB'];
  }

  function UpdateFilm($id, $data){
    CreateFilm($id, $data);
  }

  function DeleteFilm($id){
    LoadFromJson();
    $array = $GLOBALS['ArrayFakeDB'];
    unset($array[$id]);
    $GLOBALS['ArrayFakeDB'] = $array;
    SaveToJson();
  }

?>