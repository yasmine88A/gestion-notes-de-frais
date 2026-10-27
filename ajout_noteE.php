<?php
$title = "Ajouter une note de frais";
include("partials/_head.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "gestion_frais");
    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    $date_frais = mysqli_real_escape_string($conn, $_POST['date_frais']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $montant = mysqli_real_escape_string($conn, $_POST['montant']);
    $id_employe = 1; // Remplacer avec l'ID de session si nécessaire
$justificatif_noms = [];

if (isset($_FILES['justificatif']) && is_array($_FILES['justificatif']['name'])) {
    $dossier_upload = "uploads/";
    if (!is_dir($dossier_upload)) mkdir($dossier_upload, 0777, true);
$extensions_autorisees = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar'];


foreach ($_FILES['justificatif']['tmp_name'] as $index => $tmp_name) {
    if ($_FILES['justificatif']['error'][$index] === UPLOAD_ERR_OK) {
        $extension = strtolower(pathinfo($_FILES['justificatif']['name'][$index], PATHINFO_EXTENSION));

        if (in_array($extension, $extensions_autorisees)) {
            $nom_unique = time() . '_' . basename($_FILES['justificatif']['name'][$index]);
            $chemin_final = $dossier_upload . $nom_unique;

            if (move_uploaded_file($tmp_name, $chemin_final)) {
                $justificatif_noms[] = $nom_unique;
            }
        }
    }
}}


$justificatif_nom = implode(',', $justificatif_noms); // stockage séparé par virgule
    $sql = "INSERT INTO notes_frais (date_frais, type, montant, justificatif, id_employe)
            VALUES ('$date_frais', '$type', '$montant', '$justificatif_nom', '$id_employe')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Note de frais enregistrée avec succès !'); window.location.href='notefraisE.php';</script>";
        exit();
    } else {
        echo "<script>alert(\"Erreur : " . mysqli_error($conn) . "\");</script>";
    }

    mysqli_close($conn);
}
?>


<body>
  <div class="container-scroller">
    <!-- Sidebar -->
    <?php include 'partials/_sidebar1.php'; ?>

    <!-- Page content -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title ">Ajouter une Note de Frais</h4>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" class="form-control" name="date_frais" required>
                    </div>
                    <div class="form-group">
                      <label>Type</label>
                      <input type="text" class="form-control" name="type" placeholder="Type" required>
                    </div>
                    <div class="form-group">
                      <label>Montant</label>
                      <input type="number" step="0.01" class="form-control" name="montant" placeholder="Montant" required>
                    </div>
                    <div class="form-group">
                      <label>Justificatif</label>
                      <input type="file" name="justificatif[]" class="form-control" multiple>

                    </div>
                    <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                    <a href="notefraisE.php" class="btn btn-light">Annuler</a>
                  </form>
                </div>
              </div>
            

        </div>
        <!-- content-wrapper ends -->
      
      </div>
    </div>
  </div>
  <?php include 'partials/_footer.php'; ?>
  <!-- Scripts -->

</body>


