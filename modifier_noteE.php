<?php
$title = "Modifier Note de Frais";
include("partials/_head.php");

$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$id = $_GET['id'];
$sql = "SELECT * FROM notes_frais WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<body>
  <div class="container-scroller">
    <!-- Sidebar employé -->
    <?php include("partials/_sidebar1.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Modifier une Note de Frais</h4>

              <form action="update_noteE.php" method="post" enctype="multipart/form-data" class="forms-sample">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="form-group">
                  <label>Date</label>
                  <input type="date" name="date_frais" class="form-control" value="<?= $row['date_frais'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Type</label>
                  <input type="text" name="type" class="form-control" value="<?= $row['type'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Montant</label>
                  <input type="text" name="montant" class="form-control" value="<?= $row['montant'] ?>" required>
                </div>

                <div class="form-group">
                  <label>Justificatif</label>
                 <input type="file" name="justificatif[]" class="form-control" multiple>

                  <input type="hidden" name="ancien_justificatif" value="<?= $row['justificatif']; ?>">

                </div>

                <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
                <a href="notefraisE.php" class="btn btn-light">Annuler</a>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include("partials/_footer.php"); ?>
</body>
</html>
