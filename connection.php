<?php

$hostname = "localhost";
$username = "root";
$password ="";
$dbname = "mypracticework";

$conn = new mysqli($hostname,$username,$password,$dbname);
if($conn->connect_errno){
    die("Something wrong:" .$conn-> connect_errno);
}

?>