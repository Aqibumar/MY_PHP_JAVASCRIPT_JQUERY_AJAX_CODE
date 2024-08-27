<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body align='center' bgcolor="lightgrey">
    <br><br><br><br><br>
    <div class="container">
        <div class="box">
            <h2>Sign Up</h2><hr>
            <form>
                <div style="margin-top: 30px;">
                    Username:<input type="text" name="username" required><br>
                    Email:<input type="text" name="email" required><br>
                    Password:<input type="password" name="password" required><br>
                    Repeat Password:<input type="password" name="repeatpassword" required><br>
                    <input type="submit" class="btn" value="Register"><br>
                    <hr style="margin-top: 40px;">
                    Already a member? <a href="signin.php">Sign In</a><br>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Collect form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    type: "POST",
                    url: "ajaxsignup.php",
                    data: formData,
                    success: function(response) {
                        try {
                        var response = JSON.parse(response);
                        } catch (error) {
                            if (response.success) {
                            alert(response.message);
                            window.location.href = "signin.php";
                        } else {
                            alert(response.errors);
                        }
                        } 
                    },
                    error: function() {
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
</body>
</html>
