<!-- NO Longer Using it to add Data in Data base Instead i am adding the dataa through ajex -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body bgcolor="lightgrey" align='center'>
<table border="2px solid black" align="center" width='50%'>
<tr>
    <th>Sr.No</th>
    <th>Subject</th>
    <th>Maximum Marks</th>
    <th>Obtained Marks</th>
    <th>Grade</th>
</tr>

<font size='5px'>
    <?php
    echo "<div align='center'>";
    echo "<font size='5'>";
                $englishmarks = $_POST['englishmarks'];
                $mathmarks = $_POST['mathmarks'];
                $urdumarks = $_POST['urdumarks'];
                $marks= totalmarks($englishmarks,$mathmarks,$urdumarks);
                $grade=calculateOverallGrade($marks);
                $englishgrade= calculateGrade($englishmarks);
                $mathgrade= calculateGrade($mathmarks);
                $urdugrade= calculateGrade($urdumarks);

                //--------For Uploading Image--------//
                $myimage = $_FILES["img"]["name"];
                $tempname = $_FILES["img"]["tmp_name"];
                $folder = "./images/" . $myimage;
            
               //-------uploaded image into the folder--------//
               move_uploaded_file($tempname, $folder);


                echo "<h4>Student Data</h2>"."<hr>";
                echo "<img src='images/".$myimage."' alt='Student_img' width='140' height='100'>"."<br>";
                echo ('Student Name: '); echo $_POST['name'] . "<br>";
                echo ('Student Age: '); echo $_POST['age'] . "<br>";
                echo ('Student Gender: '); echo $_POST['gender'] . "<br>";
                echo ('Date Of Birth: '); echo $_POST['dob'] . "<br>";
                echo "<b>Guardian Details</b>"."<br>";
                echo ('Guardian Name: '); echo $_POST['guardianname'] . "<br>";
                echo ('Relation: '); echo $_POST['relation'] . "<br>";
                echo ('Contact NO: '); echo $_POST['contactinfo'] . "<br>". "<br>";
                echo "<b>Student Result</b>"."<br>"."<br>";
                echo "<tr>";
                echo "<td>1<br>2<br>3</td>";
                echo "<td>English<br>Math<br>Urdu</td>";
                echo "<td>100<br>100<br>100</td>";
                echo "<td>$englishmarks<br>$mathmarks<br>$urdumarks</td>";
                echo "<td>$englishgrade<br>$mathgrade<br>$urdugrade</td>";
                echo "</tr>";
                echo "</table>";
                echo "<table align='center' border='2px solid black' width='50%'>";
                echo "<tr>
                <th>Overall Marks:  $marks </th>
                <th>Overall Grade:  $grade</th>
                </tr>";
                echo "</table>";
   echo "</font>
    </div>";
    ?>
<hr></font size='2px'><div style="color: red;"><b>Data Has Been Added Successfully</b></div></font>

<?php
     include 'connection.php';
     mysqli_query($conn, "insert Into students(name,age,gender,guardianname,relationship,
     contactinfo,dob,marks,grade,englishmarks,englishgrade,mathmarks,mathgrade,urdumarks,urdugrade,studentimg)
      values(
      '".$_POST['name']."',
         $_POST[age],
      '".$_POST['gender']."',
      '".$_POST['guardianname']."',
      '".$_POST['relation']."',
      '".$_POST['contactinfo']."',
      '".$_POST['dob']."',
      '".$marks."',
      '".$grade."',
      '".$englishmarks."',
      '".$englishgrade."',
      '".$mathmarks."',
      '".$mathgrade."',
      '".$urdumarks."',
      '".$urdugrade."',
      '".$myimage."'
      )") ;

      //----------Getting the id of last data that has been addedd---------//
      $Sql= "SELECT Max(id) As max_id FROM students";
      $result=$conn->query($Sql);
      if($result){
      $row=$result->fetch_assoc();
      $maxid=$row['max_id'];
      }
     //----------Inserting data into Result table---------//
     mysqli_query($conn,"
     insert into resultcard(englishmarks,
     mathmarks,urdumarks,englishgrade,mathgrade,urdugrade,marks,grade,id)
     values ('" .$englishmarks. "'
     ,'" .$mathmarks. "'
     ,'" .$urdumarks. "'
     ,'" .$englishgrade. "'
     ,'" .$mathgrade. "'
     ,'" .$urdugrade. "'
     ,'" .$marks. "'
     ,'" .$grade . "'
     ,'" .$maxid. "'
      ) ");

    
    //---------------Functions----------------//
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