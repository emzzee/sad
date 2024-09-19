<?php
session_start();
require_once('../db/conn.php');
include('../status/status.php');
include('function.php');
$user_id = $_SESSION['USER']['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$stmt = $conn->prepare($query);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
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
    <link rel="stylesheet" href="kbuser.css">

    <title>Kasambahay</title>

</head>

<body>

    
<?php
    include('../navbar/kbnavbar.php');
    include('../navbar/kbsidebar.php');
    ?>

<section class="home-section">
        <?php if (isset($_SESSION['message'])) : ?>
                    <h5 class="alert alert-primary"><?= $_SESSION['message']; ?></h5>
                <?php unset($_SESSION['message']);
                endif; ?>

            <div class="card">


                <?php if (!empty($row)) : ?>
                    <div class="row col-lg-12 border rounded mx-auto mt-5 p-2 shadow-lg">
                        <div class="col-md-4 text-center">
                            <img src="../upload/<?php echo htmlspecialchars($row["profile"]); ?>" class="img-fluid rounded" style="width: 180px;height:180px;object-fit: fill;">
                            <div>

                                <?php if (user('user_id') == $row['user_id']) : ?>

                                    <a href="amouser-edit.php">
                                        <button class="mx-auto m-1 btn-sm btn btn-primary">Edit</button>
                                    </a>
                                    
                                        <button id="delete_user" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" onclick="setUserIdToDelete(<?= $_SESSION['USER']['user_id']; ?>)">Delete</button>
                                    
                                <?php
                                endif; ?>
                            </div>
                            
                        </div>

                        <div class="col-md-8">
                            <div class="h2">User Profile</div>
                            <table class="table table-striped">
                                <tr>
                                    <th colspan="2">User Details:</th>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-phone"></i> Mobile Number</th>
                                    <td><?= esc($row['mobile_number']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-person-circle"></i> First name</th>
                                    <td><?= esc($row['first_name']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-person-square"></i> Last name</th>
                                    <td><?= esc($row['last_name']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-geo-alt-fill"></i> Address</th>
                                    <td><?= esc($row['address']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-calendar"></i> Birthdate</th>
                                    <td><?= esc($row['birthdate']) ?></td>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-person-fill"></i> Role</th>
                                    <td><?= $role[$row['user_role']] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="text-center alert alert-danger">That profile was not found</div>
                    <a href="index.php">
                        <button class="btn btn-primary m-4">Home</button>
                    </a>
                <?php endif; ?>

            </div>




        </section>
        <?php  } ?>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>