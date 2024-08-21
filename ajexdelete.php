<?php
include "connection.php";
  $id = $_POST['id'];

  $studentquery = "DELETE FROM students WHERE id = {$id}";
  if(mysqli_query($conn,$studentquery)){
    $resultcardquery = "DELETE FROM resultcard WHERE id={$id}";
    if(mysqli_query($conn,$resultcardquery)){
    echo 1;
    }
    else{
      echo 0;
    }
  }
  else{
    echo 0;
  }
?>