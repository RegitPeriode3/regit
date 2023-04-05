<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <script src="../assets/js/CompanyManagement.js"></script>
  <ul class="sidebar-nav" id="sidebar-nav">

    <?php
    $Id = $_SESSION['clearence_id'];

    if ($Id == 1) { //normal user
    ?>

      <li class="nav-item">
        <a href="#" class="nav-link collapsed" data-target="HourRegistration">
          <i class="bi bi-clock"></i>
          <span>Uren registratie</span>
        </a>
      </li>
      <hr>
      <a href="http://localhost/regit/pages/logout.php" class="nav-link collapsed">
        <li class="nav-item">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Uitloggen</span>
        </li>
      </a>

    <?php
    } else { //admin
    ?>

      <li class="nav-item">
        <a href="#" class="nav-link collapsed" data-target="HourRegistration">
          <i class="bi bi-clock"></i>
          <span>Uren registratie</span>
        </a>
      </li>
      <!--not visible on mobile-->
      <div class="invisi-nav">
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-target="Billing">
            <i class="bi bi-archive"></i>
            <span>Facturatie</span>
          </a>
        </li>
        <hr>
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" id="CompanyManagementNav" data-target="ClientManagement">
            <i class="bi bi-file-earmark-person"></i>
            <span onclick="clearForms()">Klantbeheer</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" id="UserManagementNav" data-target="UserManagement">
            <i class="bi bi-person-gear"></i>
            <span onclick="clearForms()">Gebruikerbeheer</span>
          </a>
        </li>
        <hr>
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-target="Settings">
            <i class="bi bi-gear"></i>
            <span>Instellingen</span>
          </a>
        </li>
        <a href="http://localhost/regit/pages/logout.php" class="nav-link collapsed">
          <li class="nav-item">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Uitloggen</span>
          </li>
        </a>

      <?php
    }
      ?>

  </ul>

</aside><!-- End Sidebar-->