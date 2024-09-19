<?php
session_start();
require_once('../db/conn.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['see_details'])) {
    $user_id = $_POST['user_id'];


    // Retrieve kasambahay details from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id= :user_id AND status=1");
    $data = [
        ':user_id' => $user_id
    ];

    if ($stmt->execute($data) && $stmt->rowCount() > 0) {
        $user_data = $stmt->fetch();

        // if (isset($_SESSION['USER'])) {
        //     $user_id = $_SESSION['USER']['user_id'];
        //     $first_name = $_SESSION['USER']['first_name'];
        //     $last_name = $_SESSION['USER']['last_name'];
        //     $last_name = $_SESSION['USER']['mobile_number'];
        //     $contact = $_SESSION['USER']['address'];}
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" type="text/css" href="../style/amo-sidebar.css">
            <link rel="stylesheet" type="text/css" href="../style/amo-navbar.css">
            <link rel="stylesheet" href="admin_pendingdetails.css">

            <title>Kasambahay</title>

        </head>

        <body>

            <?php
          include('../navbar/adminnavbar.php');
          include('../navbar/adminsidebar.php');
            ?>

            <section class="home-section">
                <div class="row justify-content-center">
<h4 class="check">Check Details:</h4>
                    <div class="card">
                        <div class="container">
                            <form action="admin-crud.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="image">
                                            <img src="../upload/<?php echo htmlspecialchars($user_data["profile"]); ?>" alt="Kasambahay Profile" class="profile-pic">
                                        </div>
                                    </div>
                                    <div class="details col-md-8">
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_data["user_id"]) ?>">
                                        <h3 class="role">
                                            <?php echo htmlspecialchars($user_data["mobile_number"]); ?>
                                        </h3>  
                                        <p class="worker_details">
                                            <?php echo htmlspecialchars($user_data["first_name"]) . " " . htmlspecialchars($user_data["last_name"]); ?>
                                        </p>
                                        <p class="address">
                                            <?php echo htmlspecialchars($user_data["address"]); ?>
                                        </p>
                                        <p class="number">
                                            <?php echo htmlspecialchars($user_data["birthdate"]); ?>
                                        </p>
                                        <div class="valid_id">
                                            <img src="../upload/<?php echo htmlspecialchars($user_data["valid_id"]); ?>" alt="Kasambahay Profile" class="valid_id">
                                        </div>
                                        <button type="submit" class="btn btn-approve_user" name="approve_user">Approve</button>
                                        <button type="submit" class="btn cancel-btn" name="cancel">Back<i class='bx bx-arrow-back' ></i></button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </section>
    <?php }
} ?>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </body>

        </html>