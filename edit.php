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
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body align='center' bgcolor="lightgrey">

<?php
include "connection.php";

// Check if student_id is set, otherwise default to 1
$student_id = $_SESSION['student_id'];

// Sanitize the student_id to prevent SQL injection
$student_id = $conn->real_escape_string($student_id);

// Example query
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
    // Output data of each row
    $row = $result->fetch_assoc();
    echo "<div align='center'>";
   echo "<table border='2px solid black' align='center' width='50%'>";

   echo "<tr>
    <th>Sr.No</th>
    <th>Subject</th>
    <th>Maximum Marks</th>
    <th>Obtained Marks</th>
    <th>Grade</th>
    </tr>";
    echo "<font size='5'>";
                $englishmarks = $row['englishmarks'];
                $mathmarks = $row['mathmarks'];
                $urdumarks = $row['urdumarks'];
                $englishgrade=$row['englishgrade'];
                $mathgrade= $row['mathgrade'];
                $urdugrade= $row['urdugrade'];
                $marks =  $row['marks'];
                $grade= $row['grade'];

                echo "<hr>"."<h3>Student Data</h3>"."<hr>";
                echo "<img src='images/".$row['studentimg']."' alt='student_img' style='width: 140px;  height: 100px'><br>";
                echo ('Student Name: '); echo $row['name'] . "<br>";
                echo ('Student Age: '); echo $row['age'] . "<br>";
                echo ('Student Gender: '); echo $row['gender'] . "<br>";
                echo ('Date Of Birth: '); echo $row['dob'] . "<br>";
                echo "<b>Guardian Details</b>"."<br>";
                echo ('Guardian Name: '); echo $row['guardianname'] . "<br>";
                echo ('Relation: '); echo $row['relationship'] . "<br>";
                echo ('Contact NO: '); echo $row['contactinfo'] . "<br>". "<br>";
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
                echo "<br><hr><br>";
                echo "</font>";
                echo "</div>";
?>

<div class='box' style="margin-top: 20px;">
<form action="" method="post" align="center" enctype="multipart/form-data" > 
<h3>Edit Student Information</h3><hr>
<input type="Hidden" name="id" value="<?php echo htmlspecialchars($row['id'])?>"> <br> 
Name: <input type="text"  name="name" value="<?php echo htmlspecialchars($row['name'])?>"> <br> 
Age: <input type="number" name="age"value="<?php echo htmlspecialchars($row['age'])?>"> <br>
Grade: <input type="text" name="grade"value="<?php echo htmlspecialchars($row['grade'])?>"> <br> 
Gender: <?php echo htmlspecialchars($row['gender'])?>
 <input type="radio"  name="gender"<?php if($row['gender'] == "Male") { echo "checked"; }?> value="Male">Male
 <input type="radio"  name="gender"<?php if($row['gender'] == "Female") { echo "checked"; }?> value="Female">Female 
 <input type="radio"  name="gender"<?php if($row['gender'] == "Other") { echo "checked"; }?> value="Other">Other <br>
  Date of Birth: <input type="date"name="dob"value="<?php echo htmlspecialchars($row['dob'])?>"> <br><br>
  <input type="file" id="img" name="img"><br><br><br>

  <h3>Enter Obtained Marks</h3>
 English:<input type="number" name="englishmarks" value="<?php echo htmlspecialchars($row['englishmarks'])?>"><br>
 Math:<input type="number" name="mathmarks" value="<?php echo htmlspecialchars($row['mathmarks'])?>"><br>
 Urdu:<input type="number" name="urdumarks" value="<?php echo htmlspecialchars($row['urdumarks'])?>"><br>

  <h3>Guardian Information</h3>
 Guardian Name: <input type="text"  name="guardianname"value="<?php echo htmlspecialchars($row['guardianname'])?>"> <br>
 Relatation: <input type="text"  name="relation"value="<?php echo htmlspecialchars($row['relationship'])?>"> <br> 
 contact Info: <input type="number"  name="contactinfo"value="<?php echo htmlspecialchars($row['contactinfo'])?>"><br><br>
  <hr><input type="submit" name="submit" value="Update"> 
</form>
</div>
<?php
} else {  
    echo "Error or no results";
}

if (isset($_POST['submit']) 
&& isset($_POST['name']) 
&& isset($_POST['age'])
&& isset($_POST['dob'])
&& isset($_POST['gender'])
&& isset($_POST['guardianname'])
&& isset($_POST['relation'])
&& isset($_POST['contactinfo'])
&& isset($_POST['id'])
&& isset($_POST['grade'])
&& isset($_POST['englishmarks'])
&& isset($_POST['mathmarks'])
&& isset($_POST['urdumarks'])) 
{
    //--------For Uploading Image--------//
    $myimage = $_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];
    $folder = "./images/" . $myimage;
   //-------uploaded image into the folder--------//
    move_uploaded_file($tempname, $folder);

    echo "<hr><br><br>";
    echo "<div align='center'>";
    echo   "<font size='5'>";
    if(empty($myimage)){
        echo "<img src='images/".$row['studentimg']."' alt='student_img' style='width: 140px;  height: 100px'><br>";
    }
    else{
        echo "<img src='images/".$myimage."' alt='Student_img' width='140' height='100'>"."<br>";
    }
    echo "ID: ". htmlspecialchars($_POST['id'])."<br>";
    echo "Name: " . htmlspecialchars($_POST['name'])."<br>";
    echo "Age: " . htmlspecialchars($_POST['age'])."<br>";
    echo "Grade: " . htmlspecialchars($_POST['grade'])."<br>";
    echo "Date OF Birth: " . htmlspecialchars($_POST['dob'])."<br>";
    echo "Gender: " . htmlspecialchars($_POST['gender'])."<br>";
    echo "Guardian Name: " . htmlspecialchars($_POST['guardianname'])."<br>";
    echo "Relation: ". htmlspecialchars($_POST['relation'])."<br>";
    echo "English Marks: ". htmlspecialchars($_POST['englishmarks'])."<br>";
    echo "Math Marks: ". htmlspecialchars($_POST['mathmarks'])."<br>";
    echo "Urdu Marks: ". htmlspecialchars($_POST['urdumarks'])."<br>";
    echo "Contact Info: ". htmlspecialchars($_POST['contactinfo'])."<br>"."<br>"."<br>"."<hr>";
    echo "</font>";
    echo "</div>";

    ?>

    <div style="color: red;"><h6>Data Has Been Edited Successfully</h6></div>

     <?php
    if(empty($myimage)){
        mysqli_query($conn, "update students set 
    name = '" . $_POST['name']. "',
    age = '" . $_POST['age']. "',
    dob = '" . $_POST['dob']. "',
    gender = '" . $_POST['gender']. "',
    guardianname = '" . $_POST['guardianname']. "',
    relationship = '" . $_POST['relation']. "',
    contactinfo = '" . $_POST['contactinfo']. "',
    id = '" . $_POST['id']. "',
    englishmarks = '" . $_POST['englishmarks']. "',
    mathmarks= '" . $_POST['mathmarks']. "',
    urdumarks = '" . $_POST['urdumarks']. "',
    grade = '" . $_POST['grade']. "'
                         where students.id = '".$_POST['id']."'");

    mysqli_query($conn,"UPDATE resultcard SET 
    englishmarks ='".$_POST['englishmarks']."',
    mathmarks ='".$_POST['mathmarks']."',
    urdumarks ='".$_POST['urdumarks']."'
       WHERE resultcard.id ='".$_POST['id']."'");
    } 

    else{
    mysqli_query($conn, "update students set 
    name = '" . $_POST['name']. "',
    age = '" . $_POST['age']. "',
    dob = '" . $_POST['dob']. "',
    gender = '" . $_POST['gender']. "',
    guardianname = '" . $_POST['guardianname']. "',
    relationship = '" . $_POST['relation']. "',
    contactinfo = '" . $_POST['contactinfo']. "',
    id = '" . $_POST['id']. "',
    englishmarks = '" . $_POST['englishmarks']. "',
    mathmarks= '" . $_POST['mathmarks']. "',
    urdumarks = '" . $_POST['urdumarks']. "',
    grade = '" . $_POST['grade']. "',
    studentimg = '" .$myimage. "'
                         where students.id = '".$_POST['id']."'");
    mysqli_query($conn,"UPDATE resultcard SET 
    englishmarks ='".$_POST['englishmarks']."',
    mathmarks ='".$_POST['mathmarks']."',
    urdumarks ='".$_POST['urdumarks']."'
       WHERE resultcard.id ='".$_POST['id']."'");
    }
}
?>
</body>
</html>