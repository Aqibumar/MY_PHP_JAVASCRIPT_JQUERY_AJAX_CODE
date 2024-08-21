<?php
include "connection.php";


// Handle file upload
if (isset($_FILES["img"]) && $_FILES["img"]["name"]) {
    $myimage = $_FILES["img"]["name"];
} else {
    $myimage = '';
}

if ($myimage) {
    $tempname = $_FILES["img"]["tmp_name"];
    $folder = "./images/" . $myimage;
    move_uploaded_file($tempname, $folder);
}

if(empty($myimage)){
    $studentquery = "UPDATE students SET 
        name = '" . $_POST['name']. "',
        age = '" . $_POST['age']. "',
        dob = '" . $_POST['dob']. "',
        gender = '" . $_POST['gender']. "',
        guardianname = '" . $_POST['guardianname']. "',
        relationship = '" . $_POST['relation']. "',
        contactinfo = '" . $_POST['contactinfo']. "',
        englishmarks = '" . $_POST['englishmarks']. "',
        mathmarks= '" . $_POST['mathmarks']. "',
        urdumarks = '" . $_POST['urdumarks']. "'
        WHERE id = '".$_POST['id']."'";

    $resultcardquery = "UPDATE resultcard SET 
        englishmarks ='".$_POST['englishmarks']."',
        mathmarks ='".$_POST['mathmarks']."',
        urdumarks ='".$_POST['urdumarks']."'
        WHERE id ='".$_POST['id']."'";
} else {
    $studentquery = "UPDATE students SET 
        name = '" . $_POST['name']. "',
        age = '" . $_POST['age']. "',
        dob = '" . $_POST['dob']. "',
        gender = '" . $_POST['gender']. "',
        guardianname = '" . $_POST['guardianname']. "',
        relationship = '" . $_POST['relation']. "',
        contactinfo = '" . $_POST['contactinfo']. "',
        englishmarks = '" . $_POST['englishmarks']. "',
        mathmarks= '" . $_POST['mathmarks']. "',
        urdumarks = '" . $_POST['urdumarks']. "',
        studentimg = '" . $myimage . "'
        WHERE id = '".$_POST['id']."'";

    $resultcardquery = "UPDATE resultcard SET 
        englishmarks ='".$_POST['englishmarks']."',
        mathmarks ='".$_POST['mathmarks']."',
        urdumarks ='".$_POST['urdumarks']."'
        WHERE id ='".$_POST['id']."'";
}

if(mysqli_query($conn, $studentquery)){
    if(mysqli_query($conn, $resultcardquery)){
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}
?>
