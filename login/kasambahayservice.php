<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);


$username = null;
$password = null;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


    <title>KOB Register</title>
    <link rel="stylesheet" href="../style/amoregister.css">
</head>
<style>
    .background {

        background-image: url('../images/BG.jpg');
    }
    .form-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.form-check {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
}

.form-check input[type="checkbox"] {
    margin-right: 120px;
    
}

.btn {
    display: block; /* Make the button a block element */
    width: 50%; /* Set the width you desire */
    margin: 0 auto; /* Center the button horizontally */
}

</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top flex-md-nowrap">
        <div class="container-fluid">
            <div class="logo flex">
                <div class="logo_items">
                    <img src="../images/Kasambahay.png" alt="" />
                </div>
                <div class="logo_name" flex>CONNECT WITH TRUSTED PERSON</div>
            </div>
        </div>
    </nav>

    <div class="background">
    </div>
    <div class="container">
        <div class="box form-box">
            <div class="text-center">
                <header>Kasambahay Register</header>
            </div>
            <div class="container login">
                <form action="kasambahaysignup2.php" method="POST">
                    <div class="form-check ">
                        <label>Choose Services (Select as many as needed):</label>
                        <input type="checkbox" name="services[]" value="Child Care"> Child Care
                        <input type="checkbox" name="services[]" value="Senior Care"> Senior Care
                        <input type="checkbox" name="services[]" value="Cook"> Cook
                        <input type="checkbox" name="services[]" value="Laundry"> Laundry
                        <input type="checkbox" name="services[]" value="Maid"> Maid
                        <input type="checkbox" name="services[]" value="Family Driver"> Family Driver
                        <input type="checkbox" name="services[]" value="Houseboy"> Houseboy
                        <input type="checkbox" name="services[]" value="Store Assistant"> Store Assistant
                        <input type="checkbox" name="services[]" value="Repairman"> Repairman
                        <input type="checkbox" name="services[]" value="Plumber"> Plumber
                        <input type="checkbox" name="services[]" value="Electrician"> Electrician
                        <input type="checkbox" name="services[]" value="Gardener"> Gardener

                    </div>
                    <button type="submit" class="btn btn-dark w-75 mx-auto mt-4 " name="register_kasambahay">
                        Register as Kasambahay</button>

                </form>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>