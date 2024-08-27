<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Sign In</title>
</head>
<body align= 'center' bgcolor="lightgrey">
    <br><br><br><br><br>
<div class="container">
            <div class="box" >
            <h2>Sign In</h2><hr>
            <form>
                <div style="margin-top: 30px;">
                    Email:<input type="text" name="email" ><br>
                    Password:<input type="password" name="password" ><br>
                    <input type="submit" class="btn" name="login" value="Login"><br>
                    <hr style="margin-top: 40px;">
                    Not a member? <a href="signup.php">Sign Up</a><br>
                </div>
            </form>
            </div>
</body>

<script>
   $(document).ready( function() {
    $("form").on("submit", function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url:'ajaxsignin.php',
            type:"POST",
            data:formData,
            success: function(response){
                try {
                    if(response.success){ 
                    window.location.href = "dashboard.php";
                    }
                } catch (error) {
                    alert(response.message)
                }        
            },
            error: function(){
                alert("An error occured. Please try again")
            }
        })
    })
   })


</script>

</html>