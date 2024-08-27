
<?php
session_start();

if(isset($_POST['logout'])){
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: signin.php"); // Redirect to login page
    die();
}

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
    <title>Students Data</title>
</head>
<body bgcolor="lightgrey" align='center'>
    <form action="" method="post">
        <input type="submit" name="logout" value="LOGOUT">
   </form><br>
    <div align='center'> <a href="adddata.php" target="_blank"><button>Add Data In Table</button></a></div>

    <hr style="border-top: 8px solid grey;">
    <table class="table-bordered"  cellspacing='2px' cellpadding='2px' align="center" border= '1px solid black' style="margin-bottom: 50px;" >
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Student Age</th>
            <th>Student Gender</th>
            <th>Date of Birth</th>
            <th>Guardian Name</th>
            <th>Relationship</th>
            <th>Contactinfo</th>
            <th>English</th>
            <th>Grade</th>
            <th>Math</th>
            <th>Grade</th>
            <th>Urdu</th>
            <th>Grade</th>
            <th>Overall Marks</th>
            <th>Overall Grade</th>
            <th colspan="5">Options</th>
        </tr>
    <?php
    include_once "connection.php";
    $sql= "SELECT id,name,age,gender,dob,guardianname,relationship,contactinfo,marks,grade,englishmarks,
    englishgrade,mathmarks,mathgrade,urdumarks,urdugrade FROM students";
    $result= $conn->query($sql);
    if($result->num_rows >0){
        while ($row=$result->fetch_assoc()){
            $englishmarks = $row['englishmarks'];
            $mathmarks = $row['mathmarks'];
            $urdumarks = $row['urdumarks'];
            //-----------Calculating Totalmarks,Overallgrade and Subgrade by using classes&functions with OOP Concepts---------------//
            include_once 'oop_practice.php';
            // $marksclass = new calculatetotalmarks($englishmarks,$mathmarks,$urdumarks);
            // $marks = $marksclass-> totalmarks();
            // $overallgradeclass = new calculateOverallGrade($marks);
            // $grade = $overallgradeclass->gradecalculation();
            // $enggradeclass = new calculatesubjectgrade($englishmarks);
            // $englishgrade = $enggradeclass->gradecalculation();
            // $mathgradeclass = new calculatesubjectgrade($mathmarks);
            // $mathgrade = $mathgradeclass->gradecalculation();
            // $urdugradeclass = new calculatesubjectgrade($urdumarks);
            // $urdugrade = $urdugradeclass->gradecalculation();

            //---------------By using Abstration------------------//
            // $marksandgradeclass = new totalmarkandgrade();
            // $marks = $marksandgradeclass->totalmarks($englishmarks,$mathmarks,$urdumarks);
            // $grade = $marksandgradeclass->overallgrade($marks);
            // $englishgrade = $marksandgradeclass-> subgrade($englishmarks);
            // $urdugrade = $marksandgradeclass-> subgrade($urdumarks);
            // $mathgrade = $marksandgradeclass-> subgrade($mathmarks);

            // -----------------BY using static function so i dont have to creat an instance of a class like in above commented code------//
            $marks = totalmarkandgrade::totalmarks($englishmarks,$mathmarks,$urdumarks);
            $grade =totalmarkandgrade::overallgrade($marks);
            $englishgrade = totalmarkandgrade::subgrade($englishmarks);
            $mathgrade = totalmarkandgrade::subgrade($mathmarks);
            $urdugrade = totalmarkandgrade::subgrade($urdumarks);            
            //-----------------------------------------------------------------------------------------------//
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['age']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['dob']."</td>";
            echo "<td>".$row['guardianname']."</td>";
            echo "<td>".$row['relationship']."</td>";
            echo "<td>".$row['contactinfo']."</td>";
            echo "<td>".$englishmarks."</td>";
            echo "<td>".$englishgrade."</td>";
            echo "<td>".$mathmarks."</td>";
            echo "<td>".$mathgrade."</td>";
            echo "<td>".$urdumarks."</td>";
            echo "<td>".$urdugrade."</td>";
            echo "<td>".$marks."</td>";
            echo "<td>".$grade."</td>";
             //-------------Passed the id of student through Session----------------//
             echo"<td>"."<a href='session.php?student_id=".$row['id']." &action=view' target='_blank'><button>View</button></a>"."</td>";
             echo"<td>"."<a href='session.php?student_id=".$row['id']." &action=edit' target='_blank'><button>Edit</button></a>"."</td>";
             //-------------Passed the id of student through cookies----------------//
             echo"<td>"."<a href='cookies.php?student_id=".$row['id']."&action=copy' target='_blank'><button>Copy</button></a>"."</td>";
             echo"<td>"."<a href='cookies.php?student_id=".$row['id']."&action=delete' target='_blank'><button>Delete</button></a>"."</td>";
             //--------------Passed the id without Session & cookies-----------//
             echo"<td>"."<a href='resultcard.php?student_id=".$row['id']."' target='_blank'><button>Result Card</button></a>"."</td>";    
             echo "</tr>";

             
                mysqli_query($conn,"UPDATE students set
                grade ='".$grade."',
                marks ='".$marks."',
                englishgrade ='".$englishgrade."',
                mathgrade ='".$mathgrade."',
                urdugrade ='".$urdugrade."'
                  where students.id = '".$row['id']."'");
                     
        };

     echo "</table>";
    }
    else{
        echo "0 result";
    }
   

    ?>
</body>
</html>