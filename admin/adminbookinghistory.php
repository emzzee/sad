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
                border: 1px solid #ccc;
                /* Just for visibility */
            }

            .btn-message {
                color: #fff;
                background-color: #10674e;
                width: 90px;
            }

            .btn-cancel {
                background-color: #CF142B;
                color: #fff;
                width: 80px;
                border: none;
            }

            .th-badge {
                border: 1px solid;
                border-color: transparent;
                border-radius: .25rem;
                padding: .10rem .50rem;
                width: max-content;
                user-select: none;
                font-size: inherit;
                font-weight: bold;
                vertical-align: middle;
                text-align: center !important;
            }


            /* START-SIZE */
            .th-badge.th-size-xs {
                font-size: 10px;
            }

            .th-badge.th-size-s {
                font-size: 12px;
            }

            .th-badge.th-size-m {
                font-size: 14px;
            }

            .th-badge.th-size-small {
                font-size: 14px;
                padding: .40rem 1rem;
            }

            /* END-SIZE */





            /* START-COLORS */
            .th-badge.th-color-primary {
                background: var(--app-color-light);
                color: var(--app-color-primary) !important;
            }

            .th-badge.th-color-success,
            .th-badge.th-color-green,
            .th-badge.th-color-money {
                background: #d1fae5;
                color: #10674e !important;
            }

            .th-badge.th-color-grey,
            .th-badge-th-color-gray,
            .th-badge.th-color-pending {
                color: #1f2937;
                background-color: #f3f4f6;
            }

            /* END-COLORS */





            /* START-BORDERS */
            .th-badge.th-color-primary.th-badge-bordered {
                border-color: var(--app-color-primary);
            }

            .th-badge.th-color-success.th-badge-bordered,
            .th-badge.th-color-green.th-badge-bordered,
            .th-badge.th-color-money.th-badge-bordered {
                border-color: #10674e;
            }

            .th-badge.th-color-grey.th-badge-bordered,
            .th-badge-th-color-gray.th-badge-bordered,
            .th-badge.th-color-pending.th-badge-bordered {
                border-color: #1f2937;
            }

            /* END-BORDERS */





            /* START-INVERTED */
            .th-badge.th-color-primary.th-badge-inverted {
                background-color: var(--app-color-primary);
                color: #fff !important;
            }

            .th-badge.th-color-success.th-badge-inverted,
            .th-badge.th-color-green.th-badge-inverted,
            .th-badge.th-color-money.th-badge-inverted {
                background-color: #10674e;
                color: #fff !important;
            }

            .th-badge.th-color-grey.th-badge-inverted,
            .th-badge-th-color-gray.th-badge-inverted,
            .th-badge.th-color-pending.th-badge-inverted {
                background-color: #1f2937;
                color: #fff;
            }

            /* END-INVERTED */

            .th-badge.th-color-ready {
                color: #2544bf;
                background: #e9eeff;
            }

            .th-badge.th-color-cancel {
                color: #fa6a0a;
                background: #ffeadb;
            }

            .th-badge.th-color-orange {
                color: #fa6a0a;
                background: #ffeadb;
            }

            .th-badge.th-color-declined {
                color: #9d174d;
                background: #fce7f3;
            }

            .th-badge.th-color-red {
                color: #9d174d;
                background: #fce7f3;
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
                            $sql5 = "SELECT b.*, kb.first_name AS kb_first_name, kb.last_name AS kb_last_name,
                            amo.first_name AS amo_first_name, amo.last_name AS amo_last_name, s.service_name
                            FROM booking AS b
                            LEFT JOIN services as s ON b.service_id = s.service_id
                            LEFT JOIN users as kb ON b.kb_id = kb.user_id 
                            LEFT JOIN users as amo ON b.amo_id = amo.user_id 
                            WHERE b.status IN (2)";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>