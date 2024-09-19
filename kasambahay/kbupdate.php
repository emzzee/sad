<?php
session_start();
require('../db/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a database connection


    // Retrieve form data
    $users_id = $_SESSION['users_id']; // Replace with the actual user ID
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];

    // Update user details in the database
    $update_query = "UPDATE users SET first_name=?, last_name=?, mobile_number=?, password=?, address=?, birthdate=?  WHERE users_id=?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("sssssii", $first_name, $last_name, $mobile_number, $password, $address, $birthdate, $users_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Profile updated successfully!");</script>';
        header("Location: amouser.php");

    } else {
        echo "Error updating profile: " . $stmt->error;
    }


};

?>
