<?php
include 'connection.php';

// Check if request is an AJAX POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $guardianname = $_POST['guardianname'];
    $relation = $_POST['relation'];
    $contactinfo = $_POST['contactinfo'];
    $dob = $_POST['dob'];
    $englishmarks = $_POST['englishmarks'];
    $mathmarks = $_POST['mathmarks'];
    $urdumarks = $_POST['urdumarks'];
    
    $marks = totalmarks($englishmarks, $mathmarks, $urdumarks);
    $grade = calculateOverallGrade($marks);
    $englishgrade = calculateGrade($englishmarks);
    $mathgrade = calculateGrade($mathmarks);
    $urdugrade = calculateGrade($urdumarks);

    // Handle file upload
    if (isset($_FILES["img"])) {
        $myimage = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];
        $folder = "./images/" . $myimage;
        move_uploaded_file($tempname, $folder);
    }

    // Prepare SQL queries
    $studentquery ="INSERT INTO students (name, age, gender, guardianname, relationship, contactinfo, dob, marks, grade, englishmarks, englishgrade, mathmarks, mathgrade, urdumarks, urdugrade, studentimg)
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
      )";

    if (mysqli_query($conn,$studentquery)) {
        $maxid = $conn->insert_id; // Get last inserted ID
        $resultcardquery ="INSERT INTO resultcard (englishmarks, mathmarks, urdumarks, englishgrade, mathgrade, urdugrade, marks, grade, id) 
         values ('" .$englishmarks. "'
     ,'" .$mathmarks. "'
     ,'" .$urdumarks. "'
     ,'" .$englishgrade. "'
     ,'" .$mathgrade. "'
     ,'" .$urdugrade. "'
     ,'" .$marks. "'
     ,'" .$grade . "'
     ,'" .$maxid. "'
      ) ";

        if (mysqli_query($conn,$resultcardquery)) {
            echo 1; // Success
        } else {
            echo 0; // Failed to insert into resultcard
        }
    } else {
        echo 0; // Failed to insert into students
    }
}

// Functions
function calculateGrade($marks) {
    if ($marks >= 90) {
        return 'A*';
    } elseif ($marks >= 80) {
        return 'A';
    } elseif ($marks >= 70) {
        return 'B*';
    } elseif ($marks >= 60) {
        return 'B';
    } elseif ($marks >= 50) {
        return 'C';
    } elseif ($marks >= 40) {
        return 'D';
    } else {
        return 'F';
    }
}

function totalmarks($englishmarks, $mathmarks, $urdumarks) {
    return $englishmarks + $mathmarks + $urdumarks;
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
    } elseif ($marks >= 190) {
        return 'C';
    } elseif ($marks >= 150) {
        return 'D';
    } else {
        return 'F';
    }
}
?>
