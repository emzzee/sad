<?php
session_start();
include("../db/conn.php");
include("../db/function.php");
//Resident Signup
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $fname = test_input($_POST['first_name']);
    $lname = test_input($_POST['last_name']);
    $contact = test_input($_POST['contact']);
    $password = $_POST['password'];
    $address = test_input($_POST['address']);
    $birthdate = test_input($_POST['birthdate']);
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

    $stmt = $conn->prepare("SELECT * FROM users WHERE mobile_number = ?");
    $stmt->execute([$contact]);

    if ($stmt->num_rows > 0) {
        echo ('<script>alert(" Mobile Number already exist!");window.location = "kasambahayregister.php";</script>');
    }

    // if user password and email is not empty
    else {

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
                        ':role' => 2,
                        ':status' => 1,
                    ];

                    $query_exec = $query_run->execute($data);
                    $user_id = $conn->lastInsertId();
                    // $_SESSION['USER'] = [
                        
                    //     'user_id' => $user_id,
                    //     'first_name' => $_POST['first_name'],
                    //     'last_name' => $_POST['last_name'],
                    //     'password' => $_POST['password'],
                    //     'contact' => $_POST['contact'],
                    //     'address' => $_POST['address'],
                    //     'birthdate' => $_POST['birthdate'],
                    //     'profile' => $fileNameNew
                    // ];
                    if ($query_exec) {
                        $_SESSION['error_message'] = "Your request sent to admin for approval";
                        header('Location: login.php');
                        exit(0);
                    } else {
                        $_SESSION['error_message'] = "There's something wrong! Please provide correct details.";
                        header('Location: amoregister.php');
                        exit(0);
                    }
                } else {
                    $_SESSION['error_message'] = "Your file is too big!";
                    header('Location: amoregister.php');
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "An error uploading your file!";
                header('Location: amoregister.php');
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Cannot upload type file!";
            header('Location: amoregister.php');
            exit;
        }
    }
    
    }

    // Close the database connection
    $stmt->close();
    $insert_stmt->close();
    $con->close();



        
    
    //      // Generate a unique filename to avoid conflicts
    //         $filename = uniqid() . '_' . $profile['name'];

    //         // Move the uploaded file to the desired location
    //         $uploadDir = '../upload/';
    //         $destination = $uploadDir . $filename;
    //        if(move_uploaded_file($profile['tmp_name'], $destination)){

    //         $sql = "insert into users (first_name,last_name,mobile_number,password,profile,address,birthdate,valid_id,date,role,status)
    //         VALUES ('$fname','$lname','$contact','$password','$profile','$address','$birthdate','$credentials','$date',3,1)";
    //         if ($con->query($sql) === TRUE) {
    //           $_SESSION['status'] = "You've Successfully Registered";
    //           header("Location: ../login/login.php");
    //       } else {
    //           echo 'Error: ' . $sql . '<br>' . $con->error;
    //       }
    //   } else {
    //       echo 'Failed to move uploaded file.';
    //   }
    // }
    // }



// function test_input($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }


?>