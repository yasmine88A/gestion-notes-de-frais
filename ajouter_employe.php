<?php
$title = "Ajouter un Employé";
include("partials/_head.php");
?>

<body>
  

  <div class="container-scroller">
    
    <?php include("partials/_sidebar.php"); ?>
     
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <!-- PHP traitement -->
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $conn = mysqli_connect("localhost", "root", "", "gestion_frais");
              if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

              $id = mysqli_real_escape_string($conn, $_POST["id"]);
              $nom = mysqli_real_escape_string($conn, $_POST["nom_complet"]);
              $email = mysqli_real_escape_string($conn, $_POST["email"]);
              $role = mysqli_real_escape_string($conn, $_POST["role"]);

              $check = "SELECT id FROM employes WHERE id = '$id'";
              $result = mysqli_query($conn, $check);

              if (mysqli_num_rows($result) > 0) {
                  $message = "<div style='color:red; text-align:center; padding:10px;'>L'identifiant <strong>$id</strong> existe déjà.</div>";
              } else {
                  $sql = "INSERT INTO employes (id, nom_complet, email, role) VALUES ('$id', '$nom', '$email', '$role')";
                  if (mysqli_query($conn, $sql)) {
                      echo "<script>alert('Employé ajouté avec succès !'); window.location.href='employeA.php';</script>";
                  } else {
                      echo "<p style='color:red;text-align:center;'>Erreur : " . mysqli_error($conn) . "</p>";
                  }
              }

              mysqli_close($conn);
          }
          ?>

          <!-- Formulaire stylisé -->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ajouter un employé</h4>
              <?php if (!empty($message)) echo $message; ?>
              <form class="forms-sample" action="ajouter_employe.php" method="post">
                <div class="form-group">
                  <label>ID</label>
                  <input type="text" name="id" class="form-control" placeholder="ID" required>
                </div>
                <div class="form-group">
                  <label>Nom complet</label>
                  <input type="text" name="nom_complet" class="form-control" placeholder="Nom complet" required>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label>Rôle</label>
                  <select name="role" class="form-control" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Employé">Employé</option>
                    <option value="Manager">Manager</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                 <a href="employeA.php" class="btn btn-light">Annuler</a>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include("partials/_footer.php"); ?>
</body>
