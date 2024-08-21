<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body align= 'center' bgcolor="lightgrey">
    <br><br><br><br><br>
    <div class="container">
        <div class="box" >
            <h2>Sign Up</h2><hr>
            <form action="" method="post">
            <div style="margin-top: 30px;">
                    Username:<input type="text" name="username" required><br>
                    Email:<input type="text" name="email" require><br>
                    Password:<input type="password" name="password" require ><br>
                    Repeadpassword:<input type="password" name="repeatpassword" required><br>
                    <input type="submit" class="btn" name="register" value="Register" required><br>
                    <hr style="margin-top: 40px;">
                    Already a member? <a href="signin.php">Sign In</a><br>
            </div>
            </form>
    </div>

    <?php

   if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeatpassword"];
    
    //--------Encrypting the password here----------//
    $passwordHash= password_hash($password, PASSWORD_DEFAULT);

    $error =array();
    //---------Chcking if email is valid-------------//
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Enter a valid email";
        array_push($error,1);
    }
    if (strlen($password)<8){
        echo "Password must be atleat 8 character";
        array_push($error,1);

    }
    if ($password!== $passwordRepeat){
        echo "Password does not match";
        array_push($error,1);

    }
    //--------Check if Email is already in database----------//
    include "connection.php";
    $sql = "SELECT * FROM signup  WHERE email = '$email'";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    if($row>0){
        echo "Email already Registered!";
        array_push($error,1);
    }
    //---------------------------------------------//
    if(count($error)>0){
        
    }
     else{
        mysqli_query($conn,"INSERT INTO signup(username,email,password) VALUES(
        '".$username."',
        '".$email."',
        '".$passwordHash."'
        )"
    );
    }
}

?>   
</body>
</html>