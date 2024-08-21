<?php
include "connection.php";
  $id = $_POST['id'];

$sql = "SELECT * FROM students WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
    // Output data of each row
    $row = $result->fetch_assoc();

    $genderMaleChecked = $row['gender'] == 'Male' ? 'checked' : '';
    $genderFemaleChecked = $row['gender'] == 'Female' ? 'checked' : '';
    $genderOtherChecked = $row['gender'] == 'Other' ? 'checked' : '';

     $data ="<form> 
     <h3>Edit Student Information</h3><hr>
     <input type='Hidden' name='id' value='{$row['id']}'><br> 
     Name: <input type='text'  name='name' value='{$row['name']}'> <br> 
     Age: <input type='number' name='age'value='{$row['age']}'> <br>
     Gender: 
      <input type='radio' name='gender' value='Male' $genderMaleChecked>Male
      <input type='radio' name='gender' value='Female' $genderFemaleChecked>Female
      <input type='radio' name='gender' value='Other' $genderOtherChecked>Other <br>

       Date of Birth: <input type='date'  name='dob'value='{$row['dob']}' <br><br><br>
       <img src='images/".$row['studentimg']."' alt='student_img' style='width: 40px;  height: 40px'>
       <input type='file' name='img' name='img'><br>
     
       <h3>Enter Obtained Marks</h3>
      English:<input type='number' name='englishmarks' value='{$row['englishmarks']}'><br>
      Math:<input type='number' name='mathmarks' value='{$row['mathmarks']}'><br>
      Urdu:<input type='number' name='urdumarks' value='{$row['urdumarks']}'><br>
     
       <h3>Guardian Information</h3>
      Guardian Name: <input type='text'  name='guardianname'value='{$row['guardianname']}'> <br>
      Relatation: <input type='text'  name='relation'value='{$row['relationship']}'> <br> 
      contact Info: <input type='number'  name='contactinfo'value='{$row['contactinfo']}'><br><br>
       <hr><input type='submit' value='Update'> 
     </form>";

     echo $data;
}
