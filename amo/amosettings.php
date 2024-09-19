<?php
session_start();
require_once('../db/conn.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../style/amo-sidebar.css">
    <link rel="stylesheet" type="text/css" href="../style/amo-navbar.css">
    <link rel="stylesheet" href="index.css">

    <title>Kasambahay</title>

</head>

<body>

    <?php
    include('../navbar/amo-navbar.php');
    include('../navbar/amosidebar.php');
    ?>

    <section class="home-section">
        <div class="container">
            <div class="d-flex  justify-content-center align-items-center vh-100">

                <form class="ppupdate row shadow w-450 p-3" action="amoupdate.php" method="POST"
                    enctype="multipart/form-data">
                    <?php

                    

                    $currentuser = $_SESSION['user_id'];
                    $sql = "SELECT * FROM users WHERE user_id='$currentuser'";

                    $results = mysqli_query($con, $sql);

                    if ($results) {
                        if (mysqli_num_rows($results) > 0) {
                            while ($row = mysqli_fetch_array($results)) {
                                ?>
                                <h4 class="display-4  fs-1">Edit Profile</h4><br>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="<?php echo $row['first_name'] ?>">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="<?php echo $row['last_name'] ?>">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Contact No.</label>
                                    <input type="text" class="form-control" name="mobile_number"
                                        value="<?php echo $row['mobile_number'] ?>">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" value="<?php echo $row['password'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" name="pp">
                                    <img src="upload/<?= $user['profile'] ?>" class="rounded-circle" style="width: 70px">
                                    <input type="text" hidden="hidden" name="old_pp" value="<?= $row['profile'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Birthdate</label>
                                    <input type="date" class="form-control" name="birthdate"
                                        value="<?php echo $row['birthdate'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Valid Id</label>
                                    <input type="file" class="form-control" name="pp">
                                    <img src="upload/<?= $user['profile'] ?>" class="rounded-circle" style="width: 70px">
                                    <input type="text" hidden="hidden" name="credentials" value="<?= $row['valid_id'] ?>">
                                </div>


                                <button type="submit" class="btn btn-info">Update</button>
                            </form>
                        </div>

                        <?php
                            }
                        }
                    }
                    ?>

        </div>
    </section>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>