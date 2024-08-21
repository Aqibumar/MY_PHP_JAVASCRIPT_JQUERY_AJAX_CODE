<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign In</title>
</head>
<body align= 'center' bgcolor="lightgrey">
    <br><br><br><br><br>
<div class="container">
            <div class="box" >
            <h2>Sign In</h2><hr>
            <form action="" method="post">
                <div style="margin-top: 30px;">
                    Email:<input type="text" name="email" ><br>
                    Password:<input type="password" name="password" ><br>
                    <input type="submit" class="btn" name="login" value="Login"><br>
                    <hr style="margin-top: 40px;">
                    Not a member? <a href="signup.php">Sign Up</a><br>
                </div>
            </form>
            </div>
<?php
if(isset($_POST['login'])){
    include "connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * From signup WHERE email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row){
        if(password_verify($password,$row['password'])){
            $_SESSION['email'] = $row['email'];
            header("Location: dashboard.php");
            die();
        }else{
            echo "Wrong password";
        }

    }else{
        echo "Email is not Registered";
    }

}

?>

</body>
</html>