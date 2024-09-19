<?php
session_start();
include("../db/conn.php");
include("../db/function.php");
//Resident Signup
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $contact = test_input($_POST['contact']);
$stmt = $conn->prepare("SELECT * FROM users WHERE mobile_number = ?");
$stmt->execute([$contact]);

if ($stmt->rowCount() > 0) {
    echo ('<script>alert(" Mobile Number already exist!");window.location = "kasambahayregister.php";</script>');
}

// if user password and email is not empty
else { 
    
        $fname = test_input($_POST['first_name']);
        $lname = test_input($_POST['last_name']);

        $password = $_POST['password'];
        $address = test_input($_POST['address']);
        $birthdate = ($_POST['birthdate']);
        $date = date('Y-m-d');
        $ran_id = rand(time(), 100000000);

        $profile = $_FILES['profile'];
        $fileName = $_FILES['profile']['name'];
        $fileTmpName = $_FILES['profile']['tmp_name'];
        $fileSize = $_FILES['profile']['size'];
        $fileError = $_FILES['profile']['error'];
        $fileType = $_FILES['profile']['type'];

        $credentials = $_FILES['credentials'];
        $fileName2 = $_FILES['credentials']['name'];
        $fileTmpName2 = $_FILES['credentials']['tmp_name'];
        $fileSize2 = $_FILES['credentials']['size'];
        $fileError2 = $_FILES['credentials']['error'];
        $fileType2 = $_FILES['credentials']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $fileExt2 = explode('.', $fileName2);
        $fileActualExt2 = strtolower(end($fileExt2));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed) && in_array($fileActualExt2, $allowed)) {
            if ($fileError === 0 && $fileError2 === 0) {
                if ($fileSize < 10000000 && $fileSize2 < 10000000) {
                    $fileNameNew = uniqid($fname, true) . "." . $fileActualExt;
                    $fileDestination = '../upload/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $fileNameNew2 = uniqid($fname, true) . "." . $fileActualExt2;
                    $fileDestination2 = '../upload/' . $fileNameNew2;
                    move_uploaded_file($fileTmpName2, $fileDestination2);

                    $query = "INSERT INTO users (unique_id, first_name, last_name, mobile_number, password, profile, address, birthdate, valid_id, date, user_role, status) 
                        VALUES (:unique_id, :first_name, :last_name, :mobile_number, :password, :profile, :address, :birthdate, :valid_id, :date, :role, :status)";
                    $query_run = $conn->prepare($query);

                    
                    
                    $data = [
                        ':unique_id' => $ran_id,
                        ':first_name' => $fname,
                        ':last_name' => $lname,
                        ':mobile_number' => $contact,
                        ':password' => $password,
                        ':profile' => $fileNameNew,
                        ':address' => $address,
                        ':birthdate' => $birthdate,
                        ':valid_id' => $fileNameNew2,
                        ':date' => $date,
                        ':role' => 3,
                        ':status' => 1,
                    ];

                    $query_exec = $query_run->execute($data);
                    $user_id = $conn->lastInsertId();
                    $_SESSION['USER'] = [
                        'unique_id' => $ran_id,
                        'user_id' => $user_id,
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'password' => $_POST['password'],
                        'contact' => $_POST['contact'],
                        'address' => $_POST['address'],
                        'birthdate' => $_POST['birthdate'],
                        'profile' => $fileNameNew
                    ];
                    if ($query_exec) {
                        header('Location: kasambahayservice.php');
                        exit(0);
                    } else {
                        $_SESSION['message'] = "There's something wrong! Please provide correct details.";
                        header('Location: kasambahayregister.php');
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "Your file is too big!";
                    header('Location: kasambahayregister.php');
                    exit;
                }
            } else {
                $_SESSION['message'] = "An error uploading your file!";
                header('Location: kasambahayregister.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "Cannot upload type file!";
            header('Location: kasambahayregister.php');
            exit;
        }
    }
    
    
}

