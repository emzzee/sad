<?php
session_start();
include("../db/conn.php");
include("../db/function.php");
//Resident Signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_user'])) {

    $user_id = $_SESSION['USER']['user_id'];
    $contact = $_SESSION['USER']['mobile_number'];
    $newcontact = test_input($_POST['contact']);
    $fname = test_input($_POST['first_name']);
    $lname = test_input($_POST['last_name']);
    $address = test_input($_POST['address']);
    $birthdate = test_input($_POST['birthdate']);
    


    if (empty($profile)) {
        if ($newcontact !== $contact) {
            $query = "UPDATE users SET first_name= :first_name, last_name=:last_name, mobile_number=:mobile_number, address=:address, birthdate=:birthdate WHERE user_id=:user_id";
            $query_run = $conn->prepare($query);

            $data = [
                ':first_name' => $fname,
                ':last_name' => $lname,
                ':mobile_number' => $newcontact,
                ':address' => $address,
                ':birthdate' => $birthdate,
                ':user_id' => $user_id
            ];

            $query_exec = $query_run->execute($data);

            if ($query_exec) {
                $_SESSION['message'] = "Details updated successfully";
                header('Location: amouser.php');
                exit(0);
            } else {
                $_SESSION['message'] = "There's something wrong, Please try again.";
                header('Location: amouser-edit.php');
                exit(0);
            }
        } else{
            $query = "UPDATE users SET first_name= :first_name, last_name=:last_name, address=:address, birthdate=:birthdate WHERE user_id=:user_id";
            $query_run = $conn->prepare($query);

            $data = [
                ':first_name' => $fname,
                ':last_name' => $lname,
                ':address' => $address,
                ':birthdate' => $birthdate,
                ':user_id' => $user_id
            ];

            $query_exec = $query_run->execute($data);

            if ($query_exec) {
                $_SESSION['message'] = "Details updated successfully";
                header('Location: amouser.php');
                exit(0);
            } else {
                $_SESSION['message'] = "There's something wrong, Please try again.";
                header('Location: amouser-edit.php');
                exit(0);
            }
        }
    } else {
        $profile = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    $fileNameNew = uniqid($fname, true) . "." . $fileActualExt;
                    $fileDestination = '../upload/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $query = "UPDATE users SET first_name= :first_name, last_name=:last_name, mobile_number=:mobile_number, password=:password, profile=:profile, address=:address, birthdate=:birthdate WHERE user_id=:user_id";
                    $query_run = $conn->prepare($query);

                    $data = [
                        ':first_name' => $first_name,
                        ':last_name' => $last_name,
                        ':mobile_number' => $newcontact,
                        ':password' => $password,
                        ':address' => $teacher_id,
                        ':profile' => $fileNameNew,
                        ':birthdate' => $birthdate,
                        ':user_id' => $user_id
                    ];

                    $query_exec = $query_run->execute($data);

                    if ($query_exec) {
                        $_SESSION['message'] = "Profile and details updated successfully";
                        header('Location: amouser.php');
                        exit(0);
                    } else {
                        $_SESSION['message'] = "There's something wrong, Please try again.";
                        header('Location: amouser-edit.php');
                        exit(0);
                    }
                }
            }
        }
    }
}

if(isset($_POST['delete_user']))
{
    $user_id = $_SESSION['USER']['user_id'];


    $query = "DELETE FROM users WHERE user_id=:$user_id";
    $query_run = $conn->prepare($query);

    $data = [
        ':user_id' => $user_id
    ];

    $query_exec = $query_run->execute($data);

    if ($query_exec) {
        $_SESSION['message'] = "You're account is deleted!";
        header('Location: login.php');
        exit(0);
    } else {
        $_SESSION['message'] = "There's something wrong, please come back later!";
        header('Location: in.php');
        exit(0);
    }
}

if(isset($_POST['cancel_edit']))
{
        header('Location: amouser.php');
        exit(0);
    
}


