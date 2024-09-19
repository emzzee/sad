<?php
session_start();
require_once('../db/conn.php');
include('../status/status.php')
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


 
</head>

<body>

  <?php
  include('../navbar/kbnavbar.php');
  include('../navbar/kbsidebar.php');
  ?>

  <section class="home-section">
    <?php
    $user_id_to_display = $_SESSION['USER']['user_id']; // Replace with the actual user ID

    // Retrieve services for the specific user
    $query1 = "SELECT b.*, s.service_name, u.first_name, u.last_name, u.mobile_number, u.address FROM booking b 
        LEFT JOIN services s ON b.service_id = s.service_id
        LEFT JOIN users u ON u.user_id = b.amo_id
        WHERE b.kb_id = $user_id_to_display AND b.status=2";

    $stmt = $conn->prepare($query1);
    $stmt->execute();
    ?>
<div class="header">
  <h3 class="booking">Booking:</h3>
</div>
    <div class="table-responsive">
      <table class="table table-striped ">
        <thead>
          <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Date</th>
            <th>Queries</th>
            <th>Booking type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            foreach ($stmt as $row) {

              switch ($row['kb_status']) {
                case 1: // Pending
                  $status_icon = 'fa-solid fa-clock-rotate-left';
                  $status_color = 'th-color-orange';
                  $status_text = 'Pending';
                  $action_buttons = '
                  <form action="kb-crud.php" method="POST">
                        <input type="hidden" class="booking_id" name="booking_id" value="' . htmlspecialchars($row['booking_id']) .'">
                        <button type="submit"  name="accept_booking" class="btn btn-success see_details">Approve <i class=bx bx-detail></i></button>
                        <button type="submit" name="decline_booking" class="btn btn-danger ">Deny</button>
                    </form>
                    ';
                  break;
                case 2: // Approved
                  $status_icon = 'fa-check-circle';
                  $status_color = 'th-color-success';
                  $status_text = 'Approved';
                  $action_buttons = '
                        <a href="kbmessage.php?kb_id=' . $row['kb_id'] . '"><button class="btn btn-primary">Message</button></a>
                        <a href="rating.php?kb_id=' . $row['kb_id'] . '"><button class="btn btn-warning">End</button></a>
                    ';
                  break;
                case 3: // Declined
                  $status_icon = 'fa-times-circle';
                  $status_color = 'th-color-red';
                  $status_text = 'Declined';
                  $action_buttons = ''; // No buttons for declined
                  break;
                default:
                  $action_buttons = ''; // No buttons for other statuses or if status is not set
                  break;
              }
            ?>
              <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
              <td><?= $row['mobile_number']; ?></td>
              <td><?= $row['address']; ?></td>
              <td><?= $row['start_date']; ?></td>
              <td><?= $row['service_name']; ?></td>
              <td>
              <span class="th-badge <?php $status_color ?>">
              <?= $statusbk[$row['kb_status']] ?>
                        <i class="fas <?php echo $status_icon ?> ml-1"></i>
                    </span>
                </td>
                <td><?php echo $action_buttons ?></td>
          </tr>
          <!-- MODAL ACCEPT -->
          <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Confirm Booking Request</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <form action="logic.php" method="POST">
                    <div class="modal-body">
                      <input type="text" name="id" value="<?= $row['user_id']; ?>" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" value="Accept" name="confirm">
                </div>
                </form>
              </div>
            </div>
          </div>

          <div class="modal fade" id="deny<?= $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Deny Booking Request</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <form action="logic.php" method="POST">
                    <div class="modal-body">
                      <input type="text" name="id" value="<?= $row['user_id']; ?>" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" value="Deny" name="Deny">
                </div>
                </form>
              </div>
            </div>
          </div>
        <?php
            }
        ?>

        </tbody>
      </table>
    </div>

  </section>


  <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>