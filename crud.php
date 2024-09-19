<?php
session_start();
include("../db/connection.php");
include("../db/function.php");
//Resident Signup
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $fname = sec_input($_POST['first_name']);
    $lname = sec_input($_POST['last_name']);
    $contact = sec_input($_POST['contact']);
    $password = $_POST['password'];
    $profile = $_FILES['profile'];
    $address = sec_input($_POST['address']);
    $birthdate = sec_input($_POST['birthdate']); 
    $credentials = $_FILES['credentials'];
    
    

    //if user and email already exist
    $sql1 = "SELECT * FROM users WHERE mobile_number='$contact' LIMIT 1";
    $query = $con->query($sql1);
    $row = $query->fetch_array();

    if($row)
    {
        if($row['user'] === $contact)
        {
            echo('<script>alert("Username already taken");window.location = "amoregister.php";</script>');
        exit();
        }
    }
    // if user password and email is not empty
    if(!empty($contact) && !empty($password))
    {
         // Generate a unique filename to avoid conflicts
            $filename = uniqid() . '_' . $profile['name'];

            // Move the uploaded file to the desired location
            $uploadDir = '../uploads/';
            $destination = $uploadDir . $filename;
           if(move_uploaded_file($profile['tmp_name'], $destination)){

            $sql = "insert into users (first_name, last_name, mobile_number, password, profile, address, birthdate, valid_id, date, role, status) 
            VALUES ($fname, $lname, $contact, $password, $profile, $address, $birthdate, $credentials, $date,2 ,1)";
            if ($con->query($sql) === TRUE) {
              $_SESSION['status'] = "You've Successfully Registered";
              header("Location: ../login.php");
          } else {
              echo 'Error: ' . $sql . '<br>' . $con->error;
          }
      } else {
          echo 'Failed to move uploaded file.';
      }
    }else{
      echo('<script>alert("ehem");window.location = "register.php";</script>');
    }

}

function sec_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


function getUserById($id, $db){
    $sql = "SELECT * FROM users WHERE users_id = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute([$id]);
    
    if($stmt->rowCount() == 1){
        $user = $stmt->fetch();
        return $user;
    }else {
        return 0;
    }
}

?>
