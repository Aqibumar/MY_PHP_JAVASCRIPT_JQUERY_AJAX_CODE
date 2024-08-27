<?php

$hostname = "localhost";
$name = "root";
$password ="";
$dbname = "mypracticework";

$conn = new mysqli($hostname,$name,$password,$dbname);
if($conn->connect_errno){
    die("Something wrong:" .$conn-> connect_errno);
}

?>