<?php
include 'loginTest.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Regit</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- jquery --->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
<main style="background-image: url(../assets/img/pexels-lukas-317355.jpg); background-size: cover; background-repeat: no-repeat;">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 d-flex flex-column align-items-center justify-content-center">

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="d-flex justify-content-center py-4">
                                <a class="logo d-flex align-items-center w-auto">
                                    <span class="d-lg-block">Regit</span>
                                </a>
                            </div>

                            <p class="text-center">Login op uw account.</p>

                            <hr>

                            <form action="" method="post" class="row g-3 needs-validation" novalidate>

                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Gebruikersnaam</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Wachtwoord</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>

                                <hr class="mt-4 mb-4">

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" id="LoginButton" type="submit">Login</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

</main>

    <?php



    ?>


    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- jQuery Includes -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- craftpip confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <!-- axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- zo groep general library include -->
    <script src="https://zogroep.nl/jquery/general.js"></script>

    <!-- Main JS File's -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/UserManagement.js"></script>
    <script src="../assets/js/Hour-registration.js"></script>
    <script src="../assets/js/template.js"></script>

</body>

</html>