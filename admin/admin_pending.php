<?php
session_start();
require_once('../db/conn.php');
include('../status/status.php');
if (!isset($_SESSION['USER'])) {
    // If the USER session variable isn't set, redirect to the login page
    header('Location: ../login/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../style/amo-sidebar.css">
    <link rel="stylesheet" type="text/css" href="../style/amo-navbar.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets/vendors/chartist/chartist.min.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!--  End plugin css for this page -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <scriptd defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js">
        </script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <!-- Layout styles -->
        <link rel="stylesheet" href="index.css" />
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>


        <title>Kasambahay</title>
        <style>
        .flex-container {
            display: flex;
           
 /* Aligns items on the cross axis (vertical, by default) */
        }
        .flex-container .see_details {
margin-right: 12px;
            border: 1px solid #ccc; /* Just for visibility */
        }
    </style>
</head>

<body>

    <?php
    include('../navbar/adminnavbar.php');
    include('../navbar/adminsidebar.php');

    ?>

    <section class="home-section">
        <?php if (isset($_SESSION['message'])) : ?>
            <h5 class="alert alert-primary"><?= $_SESSION['message']; ?></h5>
        <?php unset($_SESSION['message']);
        endif; ?>

        <div class="row">
            <h4 class="mt-4 title" id="titlemanage">Manage Pending Accounts:</h4>
            <div class="col-md-12">
                <table id="managepending" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Birthdate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody><?php
                            $sql5 = "SELECT * FROM  users WHERE status=1 ORDER BY CASE user_role
                                            WHEN 2 THEN 1  -- Homeowners will get a priority value of 1
                                            WHEN 3 THEN 2  -- Kasambahays will get a priority value of 2
                                            ELSE 3 END, user_id";
                            $data = $conn->prepare($sql5);
                            $data->execute();
                            $results5 = $data->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($results5)): ?>
                                <tr>
                                    <td colspan="2">No data available in table</td> <!-- Adjust colspan to match number of columns -->
                                </tr>
                            <?php else:
                            foreach ($results5 as $users) { ?>
                            <tr>

                                <td><?php echo htmlspecialchars($users['first_name']) . " " . htmlspecialchars($users['last_name']) ?></td>
                                <td><?php echo htmlspecialchars($role[$users['user_role']]) ?></td>
                                <td><?php echo htmlspecialchars($users['mobile_number']) ?></td>
                                <td><?php echo htmlspecialchars($users['address']) ?></td>
                                <td><?php echo date("F j, Y", strtotime($users['birthdate'])) ?></td>
                                <td>
                                    <div class="flex-container">
                                    <form action="admin_pendingdetails.php" method="POST">
                                        <input type="hidden" class="user_id" name="user_id" value="<?= htmlspecialchars($users['user_id']) ?>">
                                        <a href=""></a> <button type="submit" name="see_details" class="btn btn-success see_details">Details <i class='bx bx-detail'></i></button>
                                    </form>
                                    <form action="admin-crud.php" method="POST">
                                    <input type="hidden" class="user_id" name="user_id" value="<?= htmlspecialchars($users['user_id']) ?>">
                                        <a href="admin-crud.php"> <button type="submit" name="decline_user" class="btn btn-danger decline">Decline <i class='bx bx-x'></i></button></a>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        <?php  } endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>