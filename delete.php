<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: signin.php");
    die();
}
?>


<?php
$showcontent = true;
include_once "connection.php";
if (isset($_POST['submit'])
&& isset($_POST['id'])
) {
    mysqli_query($conn, "DELETE FROM students where students.id = '".$_POST['id']."'");
    mysqli_query($conn, "DELETE FROM resultcard where resultcard.id = '".$_POST['id']."'");
    $showcontent = false;                     
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body align='center' bgcolor="lightgrey" align='center'>

<?php
if ($showcontent){
include "connection.php";

// Check if student_id is set, otherwise default to 1
$student_id = $_COOKIE['student_id'];

// Sanitize the student_id to prevent SQL injection
$student_id = $conn->real_escape_string($student_id);

// Example query
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
    // Output data of each row
    $row = $result->fetch_assoc();
    echo "<div align='center'>";
    echo  "<table border='2px solid black' align='center' width='50%'>";
    echo"<tr>
    <th>Sr.No</th>
    <th>Subject</th>
    <th>Maximum Marks</th>
    <th>Obtained Marks</th>
    <th>Grade</th>
    </tr>";
    echo "<font size ='5'>";
                $englishmarks = $row['englishmarks'];
                $mathmarks = $row['mathmarks'];
                $urdumarks = $row['urdumarks'];
                $englishgrade=$row['englishgrade'];
                $mathgrade= $row['mathgrade'];
                $urdugrade= $row['urdugrade'];
                $marks =  $row['marks'];
                $grade= $row['grade'];

                echo "<h4>Student Data</h2>"."<hr>";
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
               echo "</font>";
              echo "</table>";
?>

<form method="post" action="" align="center">
<div style="color: red;"><h6>Are you sure you want to delete this Data</h6></div>
<input type="submit" name="submit" value="Delete Anyways">
<input type="Hidden" name="id" value="<?php echo htmlspecialchars($row['id'])?>"> <br></form> 
<?php
} else {  
    echo "Error or no results";
}
}
else{
    echo "<hr><br><br>";
    echo "<div style='color: red;'><h4>Data Has Been Deleted Successfully</h4></div>";  
}


?>

</body>
</html>