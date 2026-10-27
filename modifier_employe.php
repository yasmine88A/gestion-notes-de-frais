<?php
$title = "Modifier Employé";
include("partials/_head.php");

$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    die("Erreur : " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM employes WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
}
?>

<body>
  <div class="container-scroller">
    <?php include("partials/_sidebar.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Modifier l'Employé</h4>

              <form action="update_employe.php" method="post" class="forms-sample">
                
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="form-group">
                  <label>Nom complet</label>
                  <input type="text" name="nom_complet" class="form-control" value="<?= $row['nom_complet'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Rôle</label>
                  <select name="role" class="form-control" required>
                    <option value="Employé" <?= $row['role'] == 'Employé' ? 'selected' : '' ?>>Employé</option>
                    <option value="Manager" <?= $row['role'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
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
