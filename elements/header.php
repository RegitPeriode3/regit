<?php
//session_start();

include '../pages/loginTest.php';

$username = $_SESSION['username'];


?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <span class="d-none d-lg-block">Regit</span>
    <!-- <span class="d-none d-lg-block header-company-name">bedrijfsnaam</span> -->
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class=" dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="../assets/img/profile-img.png" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block ps-2"><?php echo $username ?></span>
      </a><!-- End Profile Iamge Icon -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->