<?php
 include_once "connection.php";
  $id = $_POST["id"];

  $sql = "SELECT * FROM students WHERE id = $id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

 


  $studentquery= "INSERT INTO students(name,age,gender,dob,
  guardianname,relationship,contactinfo,grade,englishmarks,englishgrade,mathmarks,mathgrade,urdumarks,urdugrade,studentimg,marks)
  VALUES(
  '".$row['name']."',
  '".$row['age']."',
  '".$row['gender']."',
  '".$row['dob']."',
  '".$row['guardianname']."',
  '".$row['relationship']."',
  '".$row['contactinfo']."',
  '".$row['grade']."',
  '".$row['englishmarks']."',
  '".$row['englishgrade']."',
  '".$row['mathmarks']."',
  '".$row['mathgrade']."',
  '".$row['urdumarks']."',
  '".$row['urdugrade']."',
  '".$row['studentimg']."',
  '".$row['marks']."'
  )";
  
  if(mysqli_query($conn, $studentquery)){
    $maxid = $conn->insert_id;

    $resultcardquery="INSERT INTO resultcard(englishmarks,englishgrade,mathmarks,mathgrade,urdumarks,urdugrade,id,marks,grade) 
    VALUES(
    '".$row['englishmarks']."',
    '".$row['englishgrade']."',
    '".$row['mathmarks']."',
    '".$row['mathgrade']."',
    '".$row['urdumarks']."',
    '".$row['urdugrade']."',
    '".$maxid."',
    '".$row['marks']."',
    '".$row['grade']."'
    )";

    if(mysqli_query($conn,$resultcardquery)){
        echo 1;
    }else{
        echo 0;
    }
  }else{
    echo 0;
  }

  

   

?>

