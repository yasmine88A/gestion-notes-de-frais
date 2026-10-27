<!-- partials/_sidebar.php -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <!-- Profil stylisé -->
  <div class="sidebar-profile d-flex align-items-center justify-content-center" style="padding: 20px; background: linear-gradient(135deg, #6a11cb, #2575fc); text-align: center;">
    <div>
      <i class="mdi mdi-account-circle" style="font-size: 48px; color: white;"></i>
      <p style="color: white; margin: 5px 0 0;"><strong>Admin</strong></p>
    </div>
  </div>

  <!-- Menu de navigation -->
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="notefraisA.php">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">Notes de frais</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="deplacementA.php">
        <i class="mdi mdi-map-marker menu-icon"></i>
        <span class="menu-title">Déplacements</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="employeA.php">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Employés</span>
      </a>
    </li>
    <li class="nav-item  logout-item">
      <a class="nav-link" href="deconnexion.php">
        <i class="mdi mdi-logout menu-icon"></i>
        <span class="menu-title">Déconnexion</span>
      </a>
    </li>
  </ul>
</nav>
