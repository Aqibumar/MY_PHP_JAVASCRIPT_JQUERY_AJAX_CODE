<?php
session_start(); // Start the session

// Check if student_id is provided
if (isset($_GET['student_id'])) {
    $_SESSION['student_id'] = $_GET['student_id'];  // Set the session variable
}

// Redirect to the appropriate page based on the query parameter
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'view') {
        header('Location: view.php');
    } elseif ($action === 'edit') {
        header('Location: edit.php');
    } else {
        echo "Invalid action.";
    }
    exit();
} else {
    echo "No action specified.";
}
?>
