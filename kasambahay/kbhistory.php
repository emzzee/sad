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
    include('../navbar/kbnavbar.php');
    include('../navbar/kbsidebar.php');
    ?>

<section class="home-section">
        <?php if (isset($_SESSION['message'])) : ?>
            <h5 class="alert alert-primary"><?= $_SESSION['message']; ?></h5>
        <?php unset($_SESSION['message']);
        endif; ?>

        <div class="row">
            <h4 class="mt-4 title" id="titlemanage">Booking History:</h4>
            <div class="col-md-12">
                <table id="managepending" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Homeowner</th>
                            <th>Kasambahay</th>
                            <th>Service</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody><?php
                            $user_id = $_SESSION['USER']['user_id'];
                            $sql5 = "SELECT b.*, kb.first_name AS kb_first_name, kb.last_name AS kb_last_name,
                            amo.first_name AS amo_first_name, amo.last_name AS amo_last_name, s.service_name
                            FROM booking AS b
                            LEFT JOIN services as s ON b.service_id = s.service_id
                            LEFT JOIN users as kb ON b.kb_id = kb.user_id 
                            LEFT JOIN users as amo ON b.amo_id = amo.user_id 
                            WHERE b.status IN (2) AND b.kb_id = $user_id";
                            $data = $conn->prepare($sql5);
                            $data->execute();
                            $results5 = $data->fetchAll(PDO::FETCH_ASSOC);

                            $sql = "SELECT * FROM booking WHERE status = 2";
                            $icon = $conn->prepare($sql);
                            $icon->execute();


                            foreach ($icon as $row) :
                                switch ($row['status']) {
                                    case 1:
                                        $status_icon = 'fa-solid fa-clock-rotate-left';
                                        $status_color = 'th-color-orange';
                                        break;
                                    case 2:
                                        $status_icon = 'fa-check-circle';
                                        $status_color = 'th-color-success';
                                        break;
                                    case 3:
                                        $status_icon = 'fa-times-circle';
                                        $status_color = 'th-color-red';
                                        break;
                                }
                            endforeach;

                            if (empty($results5)) : ?>
                            <tr>
                                <td colspan="2">No data available in table</td> <!-- Adjust colspan to match number of columns -->
                            </tr>
                            <?php else :
                                foreach ($results5 as $users) { ?>
                                <tr>

                                    <td><?php echo htmlspecialchars($users['amo_first_name']) . " " . htmlspecialchars($users['amo_last_name']) ?></td>
                                    <td><?php echo htmlspecialchars($users['kb_first_name']) . " " . htmlspecialchars($users['kb_last_name']) ?></td>
                                    <td><?php echo htmlspecialchars($users['service_name']) ?></td>
                                    <td><?php echo htmlspecialchars($users['start_date']) ?></td>
                                    <td><?php echo htmlspecialchars($users['end_date']) ?></td>

                                </tr>
                        <?php  }
                            endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>



<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>