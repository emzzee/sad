
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
 

    <title>KOB Login</title>
    <link rel="stylesheet" href="../style/register.css">
</head>
<style>
    .background {

        background-image: url('../images/BG.jpg');
    }
</style>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top flex-md-nowrap">
    <div class="container-fluid">
        <div class="logo flex">
            <div class="logo_items">
                <img src="../images/Kasambahay.png" alt="" />
            </div>
            <div class="logo_name" flex>CONNECT WITH TRUSTED PERSON</div>
        </div>
    </div>
</nav>

    <div class="background">
    </div>
    <div class="back">
        <a href="login.php" class="login">
    <i class="bx bx-arrow-back icon"></i></a>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="box form-box">
                    <div class="text-center">
                        <header>Looking for kasambahay?</header>
                    </div>
                <form action="amoregister.php" method="POST">
                
                    <div class="field mt-3">
                        <img src="../images/2883790 1.png" alt="">
                        <input type="submit" class="btn" name="submit" value="REGISTER AS HOMEOWNER"> 
                    </div>
                </form>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-6">
                <div class="box form-box">
                    <div class="text-center">
                        <header>Looking for work?</header>
                    </div>
                <form action="kasambahayregister.php" method="POST">
                
                    <div class="field mt-3">
                        <img src="../images/4136684 1.png" alt="">
                        <input type="submit" class="btn" name="submit" value="REGISTER AS KASAMBAHAY">
                    </div>
                
                </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>