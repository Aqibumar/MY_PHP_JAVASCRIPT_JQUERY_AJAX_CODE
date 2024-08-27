<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: signin.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body class='box' bgcolor='#e6eaf'>
    
    <?php

    $student_id = $_POST["id"];
    include "connection.php";
    $sql= "SELECT students.studentimg,students.gender,students.age,students.dob,students.name,students.guardianname,resultcard.englishmarks
    ,resultcard.englishgrade,resultcard.mathmarks,resultcard.mathgrade,
    resultcard.urdumarks,resultcard.urdugrade,resultcard.result_id,resultcard.grade,resultcard.marks
     FROM students,resultcard Where  resultcard.id & students.id = $student_id";
    $result= $conn->query($sql);
    if($result->num_rows>0 ){
        $row=$result->fetch_assoc();
            $englishmarks= $row['englishmarks'];
            $mathmarks =$row['mathmarks'];
            $urdumarks =$row['urdumarks'];
            $marks = totalmarks($englishmarks,$mathmarks,$urdumarks);
            $grade = calculateOverallGrade($marks);
            $englishgrade = calculateGrade($englishmarks); 
            $mathgrade = calculateGrade($mathmarks); 
            $urdugrade = calculateGrade($urdumarks);

 $data="<div>
        <div align='center'>
        <h2>RESULT CARD</h2><hr>
        </div>
          
        <div class='container'>
        <div class='details'>
        <font size='3px'>
        <b>Student Name:</b> {$row['name']}<br>
        <b>Student Age:</b> {$row['age']}<br>
        <b>Student Gender:</b> {$row['gender']}<br>
        <b>Date Of Birth:</b> {$row['dob']}<br>
        </font>
        </div>
        <div class='image'>
        <img src='images/{$row['studentimg']}' alt='Student Image' width='70px' height='70px'>
        </div>
        </div>
        <table border='2px solid black' align='center' style='width: 600px;'>
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
        <table align='center' border='2px solid black' width='600px'>
        <tr>
        <th>Overall Marks:  $marks </th>
        <th>Overall Grade:  $grade</th>
        </tr>
        </table><br><br><br><br><hr>
        <div style='margin-top:25px;' align='center'><b>BOARD OF INTERMEDIATE & SECCONDARY EDUCATION</b></div>";


        echo $data;
            //---------Updating Data to database with Calculation-----------//
            if($row['grade'] || $row['marks'] || $row['englishgrade'] || $row['mathgrade'] || $row['urdugrade'] == null ){
                mysqli_query($conn,"UPDATE resultcard set
                grade ='".$grade."',
                marks ='".$marks."',
                englishgrade ='".$englishgrade."',
                mathgrade ='".$mathgrade."',
                urdugrade ='".$urdugrade."'
                where resultcard.result_id = '".$row['result_id']."'
                "); 
                }}


    //-----------------Functions......................//
    function calculateGrade($marks) {
        if ($marks >= 90) {
            return 'A*';
        } elseif ($marks >= 80) {
            return 'A';
        } elseif ($marks >= 70) {
            return 'B*';
        } elseif ($marks >= 60) {
            return 'B';
        }elseif ($marks >= 50) {
            return 'C';
        }
        elseif ($marks >= 40) {
            return 'D';
        }
        else {
            return 'F';
        }
    } 
     function totalmarks($englishmarks,$mathmarks,$urdumarks) {
        $calculatedmarks = $englishmarks+$mathmarks+$urdumarks;
        return $calculatedmarks;
      } 
      function calculateOverallGrade($marks) {
        if ($marks >= 280) {
            return 'A*';
        } elseif ($marks >= 250) {
            return 'A';
        } elseif ($marks >= 220) {
            return 'B*';
        } elseif ($marks >= 200) {
            return 'B';
        }elseif ($marks >= 190) {
            return 'C';
        }
        elseif ($marks >= 150) {
            return 'D';
        }
        else {
            return 'F';
        }
    } 
    ?>
</body>
</html>