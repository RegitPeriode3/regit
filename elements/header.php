<?php
session_start();

include 'C:\laragon\www\regit\pages\loginTest.php';

$_SESSION['loggedin'] = TRUE;
$username = $_SESSION['username'];

//$_SESSION['password'] = $password;
//$_SESSION['id'] = $id;


?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <span class="d-none d-lg-block">Regit</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class=" dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="../assets/img/profile-img.png" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

        <li class="nav-item">
          <a href="#" class="dropdown-item d-flex align-items-center" data-target="Settings">
            <i class="bi bi-gear"></i>
            <span>Instellingen</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="nav-item">
          <a class="dropdown-item d-flex align-items-center" >
            <i class="bi bi-box-arrow-right"></i>
            <span>Uitloggen</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->