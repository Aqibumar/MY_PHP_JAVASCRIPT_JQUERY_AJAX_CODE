<?php
header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeatpassword"];
    
    // Array to store error messages
    $error = array();

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Enter a valid email";
    }
    
    // Check if password is at least 8 characters
    if (strlen($password) < 8) {
        $error[] = "Password must be at least 8 characters";
    }
    
    // Check if passwords match
    if ($password !== $passwordRepeat) {
        $error[] = "Passwords do not match";
    }
    
    // Include database connection
    include "connection.php";

    // Check if email is already registered
    $sql = "SELECT * FROM signup WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error[] = "Email already registered";
    }

    if (count($error) === 0) {
        // Encrypt the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $sql = "INSERT INTO signup (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $passwordHash);
        
        if ($stmt->execute()) {
            echo json_encode(array('success' => true, 'message' => 'User registered successfully'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error registering user'));
        }
    } else {
        echo json_encode(array('success' => false, 'errors' => $error));
    }

    $stmt->close();
    $conn->close();
}
?>
