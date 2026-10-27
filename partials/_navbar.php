



<nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
  <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">

    <!-- Logo mini -->
    <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="#"><img src="assets/logo-mini.svg" alt="logo" /></a>

    <!-- Bouton menu responsive -->
    <button class="navbar-toggler navbar-toggler align-self-center me-2" type="button" data-toggle="minimize">
      <i class="mdi mdi-menu"></i>
    </button>

    <!-- Barre de recherche -->
    <form class="nav-link form-inline d-none d-md-block">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Recherche...">
        <div class="input-group-append">
          <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
        </div>
      </div>
    </form>

    <!-- Droite (profil, langue, etc.) -->
    <ul class="navbar-nav navbar-nav-right ml-auto">

      <!-- Notifications -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="notifDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i><span class="count">3</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="notifDropdown">
          <p class="dropdown-item">Pas de nouvelles notifications</p>
        </div>
      </li>

      <!-- Messages -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="msgDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-email-outline"></i><span class="count">2</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="msgDropdown">
          <p class="dropdown-item">Aucun message</p>
        </div>
      </li>

      <!-- Langue -->
      <li class="nav-item dropdown d-none d-xl-flex">
        <a class="nav-link dropdown-toggle" id="langDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-earth"></i> Français
        </a>
        <div class="dropdown-menu" aria-labelledby="langDropdown">
          <a class="dropdown-item">English</a>
          <a class="dropdown-item">Español</a>
        </div>
      </li>

      <!-- Profil utilisateur -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown">
          <img src="assets/user.png" alt="profile" class="nav-profile-img me-2">
          <span class="profile-name">Yaz</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <a class="dropdown-item"><i class="mdi mdi-account me-2"></i> Mon profil</a>
          <a class="dropdown-item" href="deconnexion.php"><i class="mdi mdi-logout me-2"></i> Déconnexion</a>
        </div>
      </li>
    </ul>

    <!-- Burger menu mobile -->
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
