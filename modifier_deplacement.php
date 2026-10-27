<?php
$title = "Modifier Déplacement";
include("partials/_head.php");

$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$id = $_GET['id'];
$sql = "SELECT * FROM deplacements WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<body>
  <div class="container-scroller">
    <?php include("partials/_sidebar.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Modifier un Déplacement</h4>

              <form action="update_deplacement.php" method="post" class="forms-sample">

                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="form-group">
                  <label>Date de départ</label>
                  <input type="date" name="date_depart" class="form-control" value="<?= $row['date_depart'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Date de retour</label>
                  <input type="date" name="date_retour" class="form-control" value="<?= $row['date_retour'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Coût</label>
                  <input type="text" name="cout" class="form-control" value="<?= $row['cout'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Statut</label>
                  <select name="statut" class="form-control" required>
                    <option value="En attente" <?= $row['statut'] == 'En attente' ? 'selected' : '' ?>>En attente</option>
                    <option value="Validé" <?= $row['statut'] == 'Validé' ? 'selected' : '' ?>>Validé</option>
                    <option value="Rejeté" <?= $row['statut'] == 'Rejeté' ? 'selected' : '' ?>>Rejeté</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Lieu</label>
                  <input type="text" name="lieu" class="form-control" value="<?= $row['lieu'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Motif</label>
                  <input type="text" name="motif" class="form-control" value="<?= $row['motif'] ?>" required>
                </div>

                <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
                <a href="deplacementA.php" class="btn btn-light">Annuler</a>

              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include("partials/_footer.php"); ?>
</body>
