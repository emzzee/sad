<?php
session_start();
include('../db/conn.php');

if (isset($_POST['mobile_number']) && isset($_POST['password'])) {
    $mobile_number = ($_POST['mobile_number']);
    $password = ($_POST['password']);

    $sql = "SELECT * FROM users WHERE mobile_number = :mobile_number AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['mobile_number' => $mobile_number, 'password' => $password]);

    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetch();
        if($row['status'] == 2){
        $_SESSION['USER'] = [
            'user_id' => $row['user_id'],
            'unique_id' => $row['unique_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'mobile_number' => $row['mobile_number'],
            'password' => $row['password'],
            'profile' => $row['profile'],
            'address' => $row['address'],
            'birthdate' => $row['birthdate'],
            'valid_id' => $row['valid_id'],
            'date' => $row['date'],
            'user_role' => $row['user_role'],
            'status' => $row['status'],
        ];
        

        // Check user role and redirect accordingly
        if ($row['user_role'] == 1) {
            // Admin
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['user_role'];
            header("Location: ../admin/index.php");
        } elseif ($row['user_role'] == 2) {
            // Homeowner
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['user_role'];
            header("Location: ../amo/index.php");
        } elseif ($row['user_role'] == 3) {
            // Kasambahay
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['user_role'];
            header("Location: ../kasambahay/kbindex.php");
        } else {
            // Set the session message
            $_SESSION['error_message'] = 'Access Denied';
            header("Location: login.php");
            exit; // Ensure that no further code is executed after redirection
        }
    } else {
        // Set the session message
        $_SESSION['error_message'] = "Your account is not approved yet.";
        header("Location: login.php");
        exit; // Ensure that no further code is executed after redirection
    }
} else {
    // Set the session message
    $_SESSION['error_message'] = 'Incorrect Username or Password';
    header("Location: login.php");
    exit;
} } else {
    // Form not properly submitted
    $_SESSION['error_message'] = 'Please enter Username and Password';
    header("Location: login.php");
    exit;
}
