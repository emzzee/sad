<?php
$user_id = $_SESSION['USER']['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bindValue(1, $user_id, PDO::PARAM_INT);
$stmt->execute();
 if ($stmt->rowCount() > 0) {
   $row = $stmt->fetch();
?>

<div class="sidebar ">
    <div class="logo_details">
      <div class="logo_name">HOMEOWNER</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
  
      <li>
        <a href="../amo/index.php">
          <i class="bx bx-grid-alt"></i>
          <span class="link_name">Browse</span>
        </a>
        <span class="tooltip">Browse</span>
      </li>
      <li>
        <a href="../amo/amouser.php">
          <i class="bx bx-user"></i>
          <span class="link_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="../amo/amomessage.php">
          <i class="bx bx-chat"></i>
          <span class="link_name">Chats</span>
        </a>
        <span class="tooltip">Chats</span>
      </li>
    
      <li>
        <a href="../amo/amobooking.php">
          <i class="bx bx-folder"></i>
          <span class="link_name">Booking</span>
        </a>
        <span class="tooltip">Booking</span>
      </li>
      <li>
        <a href="../amo/amouser-edit.php">
          <i class="bx bx-cog"></i>
          <span class="link_name">Settings</span>
        </a>
        <span class="tooltip">Settings</span>
      </li>
      <li class="profile"><a href="../login/logout.php">
        <div class="profile_details">
          <img src="../upload/<?php echo $row['profile']?>" alt="profile image">
          <div class="profile_content">
            <div class="name"><?php echo $row['first_name'] ?></div>
            <div class="designation">Homeowner</div>
          </div>
        </div>
        
        <i class="bx bx-log-out" id="log_out"></i>
</a>
      </li>
    </ul>
  </div>
  <?php }?>
  <!-- Scripts -->
  <script src="script.js"></script>