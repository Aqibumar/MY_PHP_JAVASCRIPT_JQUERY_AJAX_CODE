<?php
session_start();
header("Content-Type: Application/json");

if($_SERVER['REQUEST_METHOD'] === 'POST')
    include "connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * From signup WHERE email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row){
        if(password_verify($password,$row['password'])){
            $_SESSION['email'] = $row['email'];
            echo json_encode(array('success' => true, 'message' => 'Loged IN' , 'email' => $row['email']));

        }else{
            echo json_encode(array('success' => false, 'message' => 'Wrong Password' ,  ));
        }

    }else{
        echo json_encode(array('success' => true, 'message' => 'Email Not Registered' ,  ));
    }

?>