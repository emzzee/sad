<?php
session_start();
require_once('../db/conn.php');
include('../status/status.php');

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
    <link rel="stylesheet" href="index.css">

    <title>Kasambahay</title>
    <style>
        .btn-message{
            color: #fff;
            background-color: #10674e;
            width: 90px;
        }

        .btn-pay{
            color: #fff;
            background-color: #d48a00;
            width: 90px;
        }

        .btn-cancel{
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
    include('../navbar/amo-navbar.php');
    include('../navbar/amosidebar.php');
    ?>

    <section class="home-section">
        <?php
        $user_id_to_display = $_SESSION['USER']['user_id']; // Replace with the actual user ID

            // Retrieve services for the specific user
            $query1 = "SELECT b.*, s.service_name, u.first_name, u.last_name FROM booking b 
                    LEFT JOIN users u ON b.kb_id = u.user_id
                    LEFT JOIN services s ON s.service_id = b.service_id
                    WHERE b.status IN (1,2) AND b.amo_id = $user_id_to_display";

        $result = $conn->prepare($query1);


        $result->execute();
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center">KASAMBAHAY NAME</th>
                        <th class="text-center">SERVICE</th>
                        <th class="text-center">START DATE</th>
                        <th class="text-center">END DATE</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($result as $row) :
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
                        } ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) ?></td>
                            <td><?php echo $row['service_name'] ?></td>
                            <td><?php echo $row['start_date'] ?></td>
                            <td><?php echo $row['end_date'] ?></td>
                            <td>
                                <span class="th-badge <?php echo $status_color ?>">
                                    <?= $statusbk[$row['status']] ?>
                                    <i class="fas <?php echo $status_icon ?> ml-1"></i>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['status'] == 2) : ?>
                                    <a href="amopayment.php"> <button onclick="sendMessage(<?php echo $row['kb_id']; ?>);" class="btn-pay">Pay</button></a>
                                   <a href="amomessage.php"> <button onclick="sendMessage(<?php echo $row['kb_id']; ?>);" class="btn-message">Message</button></a>
                                   <a href="../review/rating.php?kasambahay_id=<?php echo $row['kb_id']; ?>&homeowner_id=<?php echo $row['amo_id']; ?>"><button class="btn-cancel" >End</button></a>
                                 

                                <?php elseif ($row['status'] == 1): ?>
                                    
                                    <button disabled title="Transaction still pending!" class="btn-dismessage">Message</button>
                                <?php endif;
                                 if ($row['status'] == 1) : ?>

                                    <button class="btn-cancel" >Cancel</button>
                                <?php endif; ?>
                                
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



    </section>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
function sendMessage(userId) {
    // Implement the logic to send a message
    console.log("Sending message to user ID: " + userId);
    // For example, redirect to a messaging page or open a modal
}
</script>
</body>

</html>