<?php
session_start();
require_once('../db/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_request'])) {
    $kasambahay_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $user_id_to_display = $_SESSION['USER']['user_id'];

    // Retrieve kasambahay details from the database
    $stmt = $conn->prepare("SELECT u.*, s.service_name, s.status, s.service_id
    FROM users AS u
    LEFT JOIN services AS s ON u.user_id = s.user_id
    WHERE s.service_id = :service_id AND u.user_id = :user_id");
    $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $kasambahay_id, PDO::PARAM_INT);

    $servicesQuery = $conn->prepare("SELECT * FROM services WHERE user_id = ?");
    $servicesQuery->execute([$kasambahay_id]);

    $result = $conn->prepare("SELECT b.*, u.first_name, u.last_name
                            FROM booking b 
                            LEFT JOIN users u ON b.kb_id = u.user_id
                            WHERE u.user_id = $kasambahay_id");
   
   $result->execute();
   $rows = $result->fetch();
   
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $user_data = $stmt->fetch();
        $servicesOffered = $servicesQuery->fetchAll(PDO::FETCH_ASSOC);
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
            <link rel="stylesheet" href="amohire.css">

            <title>Kasambahay</title>

        </head>

        <body>

            <?php
            include('../navbar/amo-navbar.php');
            include('../navbar/amosidebar.php');
            ?>

            <section class="home-section">
                <div class="row justify-content-center">

                    <div class="card">
                        <div class="container">
                            <form action="function.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="image">
                                            <img src="../upload/<?php echo htmlspecialchars($user_data["profile"]); ?>" alt="Kasambahay Profile" class="profile-pic">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['USER']["user_id"]) ?>">
                                        <input type="hidden" name="kasambahay_id" value="<?= htmlspecialchars($kasambahay_id) ?>">
                                        <input type="hidden" name="service_id" value="<?= htmlspecialchars($service_id) ?>">
                                        <h3 class="role">
                                            <?php echo htmlspecialchars($user_data["service_name"]); ?>

                                        </h3>


                                        <div class="services-column">
                                            <h4>Services Offered:</h4>
                                            <div class="services-list">
                                                <?php foreach ($servicesOffered as $service) : ?>
                                                    <div class="service-item">
                                                        <?php echo htmlspecialchars($service['service_name'])." "; ?>,
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <p class="worker_details">
                                            <?php echo htmlspecialchars($user_data["first_name"]) . " " . htmlspecialchars($user_data["last_name"]); ?>
                                        </p>
                                        <p class="address">
                                            <?php echo htmlspecialchars($user_data["address"]); ?>
                                        </p>
                                        <p class="number">
                                            <?php echo htmlspecialchars($user_data["mobile_number"]); ?>
                                        </p>
                                        <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                            </div>
                           
                            
                                        <button type="submit" class="btn hire-btn" name="hire_kasambahay">Hire Kasambahay</button>
                                     
                                    </div>

                                </div>
                            </form><a href="../review/rating.php?kasambahay_id=<?php echo $rows['kb_id']; ?>&homeowner_id=<?php echo $rows['amo_id']; ?>" class="review_button"><button type="submit" class="btn-review" >Reviews</button></a>
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