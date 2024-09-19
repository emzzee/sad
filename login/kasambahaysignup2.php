<?php
session_start();
include("../db/conn.php");
include("../db/function.php");
if(isset($_POST['register_kasambahay'])){

    $services = $_POST['services'] ?? [];
    if (isset($_SESSION['USER']) && isset($_SESSION['USER']['user_id'])) {
    $userId = $_SESSION['USER']['user_id'];

    $sql = "INSERT INTO services (service_name, user_id, status) VALUES (:service_name, :user_id, :status)";
    $query_run = $conn->prepare($sql);
    
    try {
        // Insert each service for the user
        foreach ($services as $service) {
            $query_run->execute([
                ':service_name' => $service,
                ':user_id' => $userId,
                ':status' => '1'
            ]);
        }

        // Commit the transaction
        $conn->commit();

        // Redirect or provide success message as needed
        $_SESSION['error_message'] = "Your account is currently pending approval by an admin.";
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $_SESSION['error_message'] = "Your account is currently pending approval by an admin.";
        header('Location: login.php');
        exit();
        // Handle the error (log it and show an error message to the user)
    }
} else {    $_SESSION['error_message'] = "g approval by an admin.";
        header('Location: login.php');
        exit();
    }}