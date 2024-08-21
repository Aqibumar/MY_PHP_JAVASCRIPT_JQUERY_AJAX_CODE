<?php

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
    setcookie('student_id',$student_id,time()+(60*60),"/");
}
if (isset($_GET['action'])){
    $action = $_GET['action'];
    if ($action === 'copy'){
        header('location: copy.php');
    } else if($action === 'delete'){
        header('location: delete.php');
    }
    exit();
}


?>