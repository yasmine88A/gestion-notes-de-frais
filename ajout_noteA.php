<?php
$title = "Ajouter une note de frais";
include("partials/_head.php");


// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "gestion_frais");
    if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

    $date_frais = mysqli_real_escape_string($conn, $_POST['date_frais']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $montant = mysqli_real_escape_string($conn, $_POST['montant']);
    $statut = mysqli_real_escape_string($conn, $_POST['statut']);
    $id_employe = 1; // À adapter avec session plus tard
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


    $sql = "INSERT INTO notes_frais (date_frais, type, montant, statut, justificatif, id_employe)
        VALUES ('$date_frais', '$type', '$montant', '$statut', '$justificatif_nom', '$id_employe')";


    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Note de frais enregistrée avec succès !'); window.location.href='notefraisA.php';</script>";
        exit();
    } else {
        echo "<script>alert(\"Erreur lors de l'enregistrement : " . mysqli_error($conn) . "\");</script>";
    }

    mysqli_close($conn);
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
            <h4 class="card-title">Ajouter une note de frais</h4>

            <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Date</label>
                <input type="date" name="date_frais" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Type</label>
                <input type="text" name="type" class="form-control" placeholder="Ex: Transport, Hébergement..." required>
              </div>
              <div class="form-group">
                <label>Montant</label>
                <input type="text" name="montant" class="form-control" placeholder="Ex: 1500" required>
              </div>
              <div class="form-group">
                <label>Justificatif</label>
             <input type="file" name="justificatif[]" class="form-control" multiple>

              </div>
              <div class="form-group">
                
                
                <label>Statut</label>
              <select name="statut" class="form-control" required>
                <option value="En attente" selected>En attente</option>
              </select>

              </div>
              <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
               <a href="notefraisA.php" class="btn btn-light">Annuler</a>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include("partials/_footer.php"); ?>
</body>
