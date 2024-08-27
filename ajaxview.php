<?php
include_once "connection.php";

$id = $_POST["id"];
$sql = "SELECT * FROM students WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    // Output data of each row
    $row = $result->fetch_assoc();
    $englishmarks = $row['englishmarks'];
    $mathmarks = $row['mathmarks'];
    $urdumarks = $row['urdumarks'];
    $englishgrade=$row['englishgrade'];
    $mathgrade= $row['mathgrade'];
    $urdugrade= $row['urdugrade'];
    $marks = $row['marks'];
    $grade= $row['grade'];

      $data= "<div align='center'>
               <font size='2'>
               <h3>Student Data</h3><hr>
                <img src='images/{$row['studentimg']}' alt='Student Image' width='100' height='60'><br>
                 Student Name:  {$row['name']} <br>
                 Student Age:  {$row['age']} <br>
                 Student Gender:  {$row['gender']}<br>
                 Date Of Birth:  {$row['dob']}<br>
                 <b>Guardian Details</b><br>
                 Guardian Name: {$row['guardianname']}<br>
                 Relation:   {$row['relationship']}<br>
                 Contact NO:  {$row['contactinfo']}<br><br>
                 <b>Student Result</b><br><br>
                <table border='2px solid black' align='center' width='100%'>
                <tr>
                <th>Sr.No</th>
                <th>Subject</th>
                <th>Maximum Marks</th>
                <th>Obtained Marks</th>
                <th>Grade</th>
                </tr>
                 <tr>
                 <td>1<br>2<br>3</td>
                 <td>English<br>Math<br>Urdu</td>
                 <td>100<br>100<br>100</td>
                 <td>$englishmarks<br>$mathmarks<br>$urdumarks</td>
                 <td>$englishgrade<br>$mathgrade<br>$urdugrade</td>
                  </tr>
                </table>
                <table align='center' border='2px solid black' width='100%'>
                <tr>
                <th>Overall Marks:  $marks </th>
                <th>Overall Grade:  $grade</th>
                </tr>
                </table>
                </font>
                </div>";
                
                echo $data;
} 
?>