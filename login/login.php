<?php
session_start();
include "../db/conn.php"; // include your database connection file


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


    <title>KOB Login</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<style>
    .background {

        background-image: url('../images/BG.jpg');
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top flex-md-nowrap">
        <div class="container-fluid col-lg-12 col-md-12">
            <div class="logo flex">
                <div class="logo_items">
                    <img src="../images/Kasambahay.png" alt="" />
                </div>
                <div class="logo_name" flex>CONNECT WITH TRUSTED PERSON</div>
            </div>
        </div>
    </nav>
    <div class="background"></div>
    <div class="container d-flex flex-column mt-2 login">
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> Hey! </strong> <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php

            unset($_SESSION['status']);
        }
        ?><?php if (isset($_SESSION['error_message'])) : ?>
                    <h5 class="alert alert-primary"><?= $_SESSION['error_message']; ?></h5>
                <?php unset($_SESSION['error_message']);
                endif; ?>
        <div class="box form-box">
        
            <header>KASAMBAHAY</header>
            <form action="check_login.php" method="POST">

                <div class="field input">
                    <label for="mobile_numbner">Mobile Number</label>
                    <input type="text" name="mobile_number" id="mobile_number" required>
                    <box-icon name='user'></box-icon>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <box-icon name='lock-alt'></box-icon>
                </div>
                <div class="forgot mt-3">
                    <a href="#">Forgot password?</a>
                </div>
                <div class="field mt-3">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>