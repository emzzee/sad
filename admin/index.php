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
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <scriptd defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js">
        </script>
        <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <!-- Layout styles -->
        <link rel="stylesheet" href="index.css" />
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>

        <title>Kasambahay</title>

</head>

<body>

    <?php
    include('../navbar/adminnavbar.php');
    include('../navbar/adminsidebar.php');

    ?>

    <section class="home-section">
        <div class="card">
            <div class="card-body">
                <div class="row col-md-8">
                    <div class="col-md-12">
                        <div class="d-sm-flex align-items-baseline report-summary-header">
                            <h5 class="font-weight-semibold">Report Summary</h5> <span class="ml-auto">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-3 report-inner-cards-wrapper">
                        <div class="report-inner-card color-1">
                            <div class="inner-card-text text-white">
                                <?php
                                $sql1 = "SELECT * from  users WHERE user_role = 2 AND status = 2 ";
                                $query1 = $conn->prepare($sql1);
                                $query1->execute();
                                $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                $totclass = $query1->rowCount();
                                ?>
                                <span class="report-title">Total Homeowner</span>
                                <h4><?php echo htmlentities($totclass); ?></h4>
                                <a><span class="report-count"> View Homeowner</span></a>
                            </div>
                            <div class="inner-card-icon">
                                <i class='bx bx-home-alt'></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 report-inner-cards-wrapper">
                        <div class="report-inner-card color-2">
                            <form action="" method="GET">

                                <div class="inner-card-text text-white">
                                    <?php
                                    $sql2 = "SELECT * from  users WHERE user_role = 3 AND status = 2 ";
                                    $query2 = $conn->prepare($sql2);
                                    $query2->execute();
                                    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                    $totstu = $query2->rowCount();
                                    ?>
                                    <span class="report-title">Total Kasambahay</span>
                                    <h4><?php echo htmlentities($totstu); ?></h4>
                                    <a><span class="report-count"> View Kasambahay</span></a>
                                </div>


                                <div class="inner-card-icon ">
                                    <i class="icon-user"></i>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="col-md-3 report-inner-cards-wrapper">
                        <div class="report-inner-card color-3">
                            <div class="inner-card-text text-white">
                                <?php
                                $sql3 = "SELECT * from  users WHERE status = 1 ";
                                $query3 = $conn->prepare($sql3);
                                $query3->execute();
                                $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                $totnotice = $query3->rowCount();
                                ?>
                                <span class="report-title">Pending Users</span>
                                <h4><?php echo htmlentities($totnotice); ?></h4>
                                <a><span class="report-count"> View Pending Users</span></a>
                            </div>
                            <div class="inner-card-icon ">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 report-inner-cards-wrapper">
                        <div class="report-inner-card color-4">
                            <div class="inner-card-text text-white">
                                <?php
                                $sql4 = "SELECT * from  users WHERE user_role IN (2,3) AND status=2";
                                $query4 = $conn->prepare($sql4);
                                $query4->execute();
                                $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
                                $totpublicnotice = $query4->rowCount();
                                ?>
                                <span class="report-title">Total users</span>
                                <h4><?php echo htmlentities($totpublicnotice); ?></h4>
                                <a><span class="report-count"> View Total Users</span></a>
                            </div>
                            <div class="inner-card-icon">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4 class="mt-4">Total Users:</h4>
                    <div class="col-md-12">
                        <table id="example" class="table table-striped" style="width:100%">
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
                                    $sql5 = "SELECT * FROM users WHERE status = 2 AND user_role IN (2,3) ORDER BY CASE user_role
                                            WHEN 2 THEN 1  -- Homeowners will get a priority value of 1
                                            WHEN 3 THEN 2  -- Kasambahays will get a priority value of 2
                                            ELSE 3 END, user_id";
                                    $data = $conn->prepare($sql5);
                                    $data->execute();
                                    $results5 = $data->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($results5 as $users) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($users['first_name']) . " " . htmlspecialchars($users['last_name']) ?></td>
                                        <td><?php echo htmlspecialchars($role[$users['user_role']]) ?></td>
                                        <td><?php echo htmlspecialchars($users['mobile_number']) ?></td>
                                        <td><?php echo htmlspecialchars($users['address']) ?></td>
                                        <td><?php echo date("F j, Y", strtotime($users['birthdate'])) ?></td>
                                        <td>
                                                <a title="Edit Student" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit fa-lg"></i></a>
                                        </td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                    </div>
                </div>
            </div>
        </div>



    </section>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Total Class', 4],
                ['Total Students', 10],
                ['Total Class Notice', 2],
                ['Total Public Notice', 2]
            ]);

            var options = {
                title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>