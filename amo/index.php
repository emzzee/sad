<?php
session_start();
require_once('../db/conn.php');
if (!isset($_SESSION['USER'])) {
    // If the USER session variable isn't set, redirect to the login page
    header('Location: login.php');
    exit();
}
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
    .star-light
{
	color:#e9ecef;
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
        $role = 3; // Replace with the actual user ID

        // Retrieve services for the specific user
        $query1 = "SELECT u.*, s.service_name, s.status, s.service_id
                   FROM users u
                   LEFT JOIN services AS s ON u.user_id = s.user_id
                   WHERE u.user_role = 3 AND s.status = 1 AND u.status=2";

        // $query6 = "SELECT users.*, services.service_name
        // FROM users
        // LEFT JOIN services ON users.user_id = services.users_id WHERE user_role = 3";

        $result = $conn->prepare($query1);
        $result->execute();
        //FILTER BUTTON
        if (isset($_POST['filter'])) {
            $service = $_POST['service'];
            if ($service != "") {
                // If a role is selected, filter based on the role using a JOIN
                $query = "SELECT u.*, s.service_name, s.status, s.service_id
                          FROM users AS u
                          LEFT JOIN services AS s ON u.user_id = s.user_id
                          WHERE s.service_name= :service AND u.user_role=3 AND u.status=2;";
                $result = $conn->prepare($query);
                if (isset($_POST['filter']) && $service != "") {
                    $result->bindParam(':service', $service, PDO::PARAM_STR);
                    
                    $result->execute();
                }
            } else {
                $query1 = "SELECT u.*, s.service_name, s.status, s.service_id
                            FROM users u
                            LEFT JOIN services AS s ON u.user_id = s.user_id
                            WHERE u.user_role = 3 AND u.status=2;";
                $result = $conn->prepare($query1);
                $result->execute();
            }
        }
        ?>
        <div class="container">
            <form name="filter" method="POST" action="">
                <select class="service w-25" name="service" id="service">
                    <option value=""> </option>
                    <option value="Child Care">Child Care</option>
                    <option value="Senior Care">Senior Care</option>
                    <option value="Cook">Cook</option>
                    <option value="Laundry">Laundry</option>
                    <option value="Maid">Maid</option>
                    <option value="Driver">Family Driver</option>
                    <option value="Houseboy">Houseboy</option>
                    <option value="Store Assistant">Store Assistant</option>
                    <option value="Repair Man">Repair Man</option>
                    <option value="Gardener">Gardener</option>

                </select>

                <button name="filter" class="btn btn-success"> Filter </button>
            </form>
        </div>

        <div class="row mt-4 justify-content-center">
            <?php
            // Display services in one card
            // Check if there are any results
            if ($result->rowCount() > 0) {
                // Fetch data as associative array
                while ($user_data = $result->fetch()) {
                    $kasambahay_id = htmlspecialchars($user_data['user_id']);
                    $service_id = htmlspecialchars($user_data['service_id']);
            ?>
                    <div class="card">
                        <form action="amohire.php" method="POST">
                        <h5 class="text-warning mt-4 mb-4">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                </h5>
                                <div class="mb-3">
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                </div>
                            <input type="hidden" class="user_id" name="user_id" value="<?= htmlspecialchars($kasambahay_id)?>">
                            <input type="hidden" class="service_id" name="service_id" value="<?= htmlspecialchars($service_id)?>">
                            <div class="image">
                                <img src="../upload/<?php echo htmlspecialchars($user_data["profile"]); ?>" width="70" height="100" alt="">
                            </div>
                            <div class="description">
                                
                                <h3 class="role"> 
                                    <?php echo htmlspecialchars($user_data["service_name"]); ?>
                                </h3>
                                <p class="worker_details">
                                    <?php echo htmlspecialchars($user_data["first_name"]) . " " . htmlspecialchars($user_data["last_name"]); ?>
                                </p>
                                <p class="address">
                                    <?php echo htmlspecialchars($user_data["address"]); ?>
                                </p>
                                <p class="number">
                                    <?php echo htmlspecialchars($user_data["mobile_number"]); ?>
                                </p>
                            </div>
                            <button type="button" class="btn view_details" name="view_details" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $kasambahay_id; ?>">View Details</button>
                            <button type="submit" class="btn send_request" name="send_request" data-kasambahay-id="<?= $kasambahay_id; ?>">Hire Kasambahay</button>
                        </form>
                    </div>

            <?php
                }
            } else {
                echo "<p>No kasambahay found for the selected service.</p>";
            }
            ?>
        </div>


    </section>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){

var rating_data = 0;

$('#add_review').click(function(){

    $('#review_modal').modal('show');

});

$(document).on('mouseenter', '.submit_star', function(){

    var rating = $(this).data('rating');

    reset_background();

    for(var count = 1; count <= rating; count++)
    {

        $('#submit_star_'+count).addClass('text-warning');

    }

});

function reset_background()
{
    for(var count = 1; count <= 5; count++)
    {

        $('#submit_star_'+count).addClass('star-light');

        $('#submit_star_'+count).removeClass('text-warning');

    }
}

$(document).on('mouseleave', '.submit_star', function(){

    reset_background();

    for(var count = 1; count <= rating_data; count++)
    {

        $('#submit_star_'+count).removeClass('star-light');

        $('#submit_star_'+count).addClass('text-warning');
    }

});

$(document).on('click', '.submit_star', function(){

    rating_data = $(this).data('rating');

});

$('#save_review').click(function(){
    var kb_name = $('#kb_name').val();

    var user_name = $('#user_name').val();

    var user_review = $('#user_review').val();

    if(user_name == '' || user_review == '')
    {
        alert("Please Fill Both Field");
        return false;
    }
    else
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{rating_data:rating_data, user_name:user_name, kb_name:kb_name, user_review:user_review},
            success:function(data)
            {
                $('#review_modal').modal('hide');

                load_rating_data();

                alert(data);
            }
        })
    }

});

load_rating_data();

function load_rating_data()
{
    var kb_name = $('#kb_name').val();

    $.ajax({
        url:"submit_rating.php",
        method:"POST",
        data: {
        kb_name: kb_name, // Use the parameter here
        action: "load_data"
    },
        dataType:"JSON",
        success:function(data)
        {
            $('#average_rating').text(data.average_rating);
            $('#total_review').text(data.total_review);

            var count_star = 0;

            $('.main_star').each(function(){
                count_star++;
                if(Math.ceil(data.average_rating) >= count_star)
                {
                    $(this).addClass('text-warning');
                    $(this).addClass('star-light');
                }
            });

            $('#total_five_star_review').text(data.five_star_review);

            $('#total_four_star_review').text(data.four_star_review);

            $('#total_three_star_review').text(data.three_star_review);

            $('#total_two_star_review').text(data.two_star_review);

            $('#total_one_star_review').text(data.one_star_review);

            $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

            $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

            $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

            $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

            $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

            if(data.review_data.length > 0)
            {
                var html = '';

                for(var count = 0; count < data.review_data.length; count++)
                {
                    html += '<div class="row mb-3">';

                    html += '<div class="col-sm-1"></div>';

                    html += '<div class="col-sm-11">';

                    html += '<div class="card">';

                    html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                    html += '<div class="card-body">';

                    for(var star = 1; star <= 5; star++)
                    {
                        var class_name = '';

                        if(data.review_data[count].rating >= star)
                        {
                            class_name = 'text-warning';
                        }
                        else
                        {
                            class_name = 'star-light';
                        }

                        html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                    }

                    html += '<br />';

                    html += data.review_data[count].user_review;

                    html += '</div>';

                    html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                    html += '</div>';

                    html += '</div>';

                    html += '</div>';
                }

                $('#review_content').html(html);
            }
        }
    })
}

});

</script>


</body>

</html>