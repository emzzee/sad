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

</head>

<body>

  <?php
  include('../navbar/kbnavbar.php');
  include('../navbar/kbsidebar.php');
  ?>

  <section class="home-section">
    <div class="wrapper">
      <section class="users">
        <header>
          <div class="content">
            <?php
            $sql = $conn->prepare("SELECT * FROM users WHERE unique_id = {$_SESSION['USER']['unique_id']}");
            $sql->execute();
            if ($sql->rowCount() > 0) {
              $row = $sql->fetch();
            }
            ?>
            <img src="../upload/<?php echo $row['profile']; ?>" alt="asdf">
            <div class="details">
              <span><?php echo $row['first_name'] . " " . $row['last_name'] ?></span>
              <p><?php echo $role[$row['user_role']]; ?></p>
            </div>
          </div>
          
        </header>
        <div class="search">
          <span class="text">Select an user to start chat</span>
          <input type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">

        </div>
      </section>
    </div>
  </section>

  <script src="../javascript/users1.js"></script>
  <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>