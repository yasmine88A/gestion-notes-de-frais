<?php
$title = "Créer une Demande de Déplacement";
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

              $date_depart = mysqli_real_escape_string($conn, $_POST["date_depart"]);
              $date_retour = mysqli_real_escape_string($conn, $_POST["date_retour"]);
              $cout = mysqli_real_escape_string($conn, $_POST["cout"]);
              $statut = mysqli_real_escape_string($conn, $_POST["statut"]);
              $lieu = mysqli_real_escape_string($conn, $_POST["lieu"]);
              $motif = mysqli_real_escape_string($conn, $_POST["motif"]);

              $sql = "INSERT INTO deplacements (date_depart, date_retour, cout, statut, lieu, motif)
                      VALUES ('$date_depart', '$date_retour', '$cout', '$statut', '$lieu', '$motif')";

              if (mysqli_query($conn, $sql)) {
                  echo "<script>alert('Déplacement ajouté avec succès'); window.location.href='deplacementA.php';</script>";
              } else {
                  echo "<p style='color:red;text-align:center;'>Erreur : " . mysqli_error($conn) . "</p>";
              }

              mysqli_close($conn);
          }
          ?>

          <!-- Formulaire stylisé -->
          <div class="card">

            <div class="card-body">
              <h4 class="card-title">Créer une Demande de Déplacement</h4>
              <form class="forms-sample" action="ajout_deplacement.php" method="post">
                <div class="form-group">
                  <label>Date de départ</label>
                  <input type="date" name="date_depart" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Date de retour</label>
                  <input type="date" name="date_retour" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Coût</label>
                  <input type="text" name="cout" class="form-control" placeholder="Ex: 1500" required>
                </div>
                <div class="form-group">
                  <label>Statut</label>
                  <select name="statut" class="form-control" required>
                   <option value="En attente" selected>En attente</option>
                  </select>

                </div>
                <div class="form-group">
                  <label>Lieu</label>
                  <select name="lieu" class="form-control" required>
                    <option value="" disabled selected>-- Sélectionner --</option>
                    <option value="Casablanca">Casablanca</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Laayoune">Laayoune</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Motif</label>
                  <input type="text" name="motif" class="form-control" placeholder="Ex: Réunion, Mission..." required>
                </div>
                <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
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
