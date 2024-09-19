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
  include('../navbar/amo-navbar.php');
  include('../navbar/amosidebar.php');
  ?>

  <section class="home-section">
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          // Ensure $pdo is the PDO connection object from config.php
          $user_id = $_GET['user_id']; // Consider validating and sanitizing this input
          $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
          $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
          $stmt->execute();
          
          if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
          } else {
            header("location: users.php");
          }
        ?>
        <a href="amomessage.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../upload/<?php echo htmlspecialchars($row['profile']); ?>" alt="">
        <div class="details">
          <span><?php echo htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']); ?></span>
          <p>
            <?php
            //  echo htmlspecialchars($row['status']); 
             ?>
        </p>
        </div>
      </header>
      <div class="chat-box">
        <!-- Chat content -->
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id); ?>" hidden>

        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  </section>

  <script src="../javascript/chat.js"></script>
  <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>