<?php
if(session_status() === PHP_SESSION_NONE) session_start();


?>
<link href="../assets/img/favicon.png" rel="icon">
<link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
<link href="../assets/img/profile-img.png" rel="icon">

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

<div id="selectBedrijf" class="content">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-7 d-flex flex-column align-items-center justify-content-center">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex justify-content-center py-4">
                        <a class="logo d-flex align-items-center w-auto">
                            <span class="d-lg-block">Regit</span>

                        </a>

                    </div>


                    <hr>

                    <form class="row g-3 needs-validation" novalidate="">


                        <ol id="companyList" class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div  class="fw-bold">Subheading</div>

                                </div>

                            </li>
                        </ol>
                </div>


                        <hr class="mt-4 mb-4">



                    </form>

                </div>
            </div>

        </div>




