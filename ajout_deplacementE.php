<?php
$title = "Ajouter un déplacement";
include("partials/_head.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "gestion_frais");

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    $date_depart = mysqli_real_escape_string($conn, $_POST['date_depart']);
    $date_retour = mysqli_real_escape_string($conn, $_POST['date_retour']);
    $cout = mysqli_real_escape_string($conn, $_POST['cout']);
    $reglement = mysqli_real_escape_string($conn, $_POST['reglement']);
    $lieu = mysqli_real_escape_string($conn, $_POST['lieu']);
    $motif = mysqli_real_escape_string($conn, $_POST['motif']);
    $id_employe = 1; // à changer si tu ajoutes la session utilisateur

    $sql = "INSERT INTO deplacements (date_depart, date_retour, cout, reglement, lieu, motif, id_employe)
            VALUES ('$date_depart', '$date_retour', '$cout', '$reglement', '$lieu', '$motif', '$id_employe')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Déplacement enregistré avec succès'); window.location.href='deplacementE.php';</script>";
    } else {
        echo "<script>alert(\"Erreur : " . mysqli_error($conn) . "\");</script>";
    }

    mysqli_close($conn);
}
?>

<body>
  <div class="container-scroller">
    <!-- Sidebar employé -->
    <?php include 'partials/_sidebar1.php'; ?>

    <!-- Contenu -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Créer une demande de déplacement</h4>
              <form method="POST" class="forms-sample">

                <div class="form-group">
                  <label>Date de départ</label>
                  <input type="date" class="form-control" name="date_depart" required>
                </div>

                <div class="form-group">
                  <label>Date de retour</label>
                  <input type="date" class="form-control" name="date_retour" required>
                </div>

                <div class="form-group">
                  <label>Coût</label>
                  <input type="text" class="form-control" name="cout" placeholder="Coût" required>
                </div>

                <div class="form-group">
                  <label>Règlement</label>
                  <select name="reglement" class="form-control" required>
                    <option value="" disabled selected>-- Sélectionner --</option>
                    <option value="Remboursement">Remboursement</option>
                    <option value="Avance">Avance</option>
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
                  <input type="text" class="form-control" name="motif" placeholder="Motif" required>
                </div>

                <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                <a href="deplacementE.php" class="btn btn-light">Annuler</a>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'partials/_footer.php'; ?>
</body>
