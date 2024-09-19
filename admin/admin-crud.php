<?php 
session_start();
include('../db/conn.php');

if(isset($_POST['decline_user'])){
    $user_id = $_POST['user_id'];

    $query = "UPDATE users SET status = 3 WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $data = [
        ':user_id' => $user_id
    ];
    $result = $stmt->execute($data);

    if ($result) {
        $_SESSION['message'] = "Decline User";
        header('Location: admin_pending.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Please try again ";
        header('Location: admin_pending.php');
        exit(0);
    }
}


if(isset($_POST['cancel'])){
    header('Location: admin_pending.php');
}

if(isset($_POST['approve_user'])){
    $user_id = $_POST['user_id'];

    $query = "UPDATE users SET status=2 WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $data = [
        ':user_id' => $user_id
    ];
    $result = $stmt->execute($data);

    if ($result) {
        $_SESSION['message'] = "Approve User";
        header('Location: admin_pending.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Please try again ";
        header('Location: admin_pending.php');
        exit(0);
    }
}


if(isset($_POST['approve_booking'])){
    $booking_id = $_POST['booking_id'];

    $query = "UPDATE booking SET status=2 WHERE booking_id = :booking_id";
    $stmt = $conn->prepare($query);
    $data = [
        ':booking_id' => $booking_id
    ];
    $result = $stmt->execute($data);

    if ($result) {
        $_SESSION['message'] = "Approve Booking";
        header('Location: adminbooking.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Please try again ";
        header('Location: adminbooking.php');
        exit(0);
    }
}


if(isset($_POST['decline_booking'])){
    $service_id = $_POST['user_id'];

    $query = "UPDATE booking SET status=3 WHERE booking_id = :service_id";
    $stmt = $conn->prepare($query);
    $data = [
        ':service_id' => $service_id
    ];
    $result = $stmt->execute($data);

    if ($result) {
        $_SESSION['message'] = "Declined Booking";
        header('Location: adminbooking.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Please try again ";
        header('Location: adminbooking.php');
        exit(0);
    }
}
?>