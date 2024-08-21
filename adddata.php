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
    <title>Add User Data</title>
</head>
<body bgcolor="lightgrey">
    <br><br>
    <div align = "center"  class="box">
    <form action="result.php", method="post", align="center", enctype="multipart/form-data">
        <h2>Student Information</h2><hr><br>
        Name: <input type="text" id="name" name="name" required><br>
        Age: <input type="number" id="age" name="age" required><br>
        Gender: <input type="radio" id="gender" name="gender" value="Male" required>Male
                <input type="radio" id="gender" name="gender" value="Female" required>Female
                <input type="radio" id="gender" name="gender" value="Other" required>Other 
                <br>
        Date of Birth: <input type="date" id="dob" name="dob" required><br><br>
        <input type="file" id="img" name="img" required><br><br><br>

        <b>Enter Obtained Marks</b><br><br>
        English: <input type="number" name="englishmarks" id="english" required> <br>
        Math: <input type="number" name="mathmarks" id="math" required> <br>
        Urdu: <input type="number" name="urdumarks" id="urdu" required> <br><br>
        
        <b>Guardian Details</b><br><br>
        Guardian Name: <input type="text" id="guardianname" name="guardianname" required><br>
        Relatation: <input type="text" id="relation" name="relation" required><br>
        contact Info: <input type="number" id="contactinfo" name="contactinfo" required><br><br><hr>
        
        <input type="submit" id="add" value="Add" class="add" style="width: 100px; height: 25px">
    </form>
    </div>

  
    
</body>
</html>