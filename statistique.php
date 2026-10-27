<?php
$title = "Statistiques";
include("partials/_head.php"); // <head> + CSS
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

// Filtres
$where = [];
if (!empty($_GET['employe'])) $where[] = "nf.id_employe = '" . mysqli_real_escape_string($conn, $_GET['employe']) . "'";
if (!empty($_GET['mois'])) $where[] = "MONTH(nf.date_frais) = '" . mysqli_real_escape_string($conn, $_GET['mois']) . "'";
if (!empty($_GET['montant'])) {
  $montant = $_GET['montant'];
  $where[] = $montant == '1000' ? "nf.montant < 1000" : "nf.montant >= 1000";
}
$where[] = "u.role = 'admin'";
$condition = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

// Requêtes
$sql1 = "SELECT u.nom AS employe, COUNT(nf.id) AS total_notes, SUM(nf.montant) AS total_montant
         FROM notes_frais nf JOIN users u ON nf.id_employe = u.id_employe $condition GROUP BY u.nom";
$employe_stats = mysqli_fetch_all(mysqli_query($conn, $sql1), MYSQLI_ASSOC);

$sql2 = "SELECT DATE_FORMAT(nf.date_frais, '%Y-%m') AS mois, SUM(nf.montant) AS total_montant
         FROM notes_frais nf JOIN users u ON nf.id_employe = u.id_employe $condition GROUP BY mois";
$mois_stats = mysqli_fetch_all(mysqli_query($conn, $sql2), MYSQLI_ASSOC);

$sql3 = "SELECT nf.type, SUM(nf.montant) AS total_par_type
         FROM notes_frais nf JOIN users u ON nf.id_employe = u.id_employe $condition GROUP BY nf.type";
$type_stats = mysqli_fetch_all(mysqli_query($conn, $sql3), MYSQLI_ASSOC);

$employes = mysqli_query($conn, "SELECT id_employe, nom FROM users WHERE role = 'admin'");
mysqli_close($conn);
?>

<body>
<div class="container-scroller">
  <!-- SIDEBAR -->
  <?php include("partials/_sidebar3.php"); ?>

  <div class="container-fluid page-body-wrapper">
    <!-- NAVBAR si tu en as une -->

    <div class="main-panel">
      <div class="content-wrapper">
<div class="my-4">
<h3 class="fw-bold mb-2">Filtrer par :</h3>
 <!-- Aligné à gauche par défaut -->
  
  <form method="GET" action="statistique.php" class="d-flex flex-wrap justify-content-center align-items-end gap-2" style="max-width: 1000px; margin: auto;">
    
    <div>
      <select class="form-select form-select-sm" name="employe" style="min-width: 160px;">
        <option value="">-- Employé --</option>
        <?php while ($emp = mysqli_fetch_assoc($employes)) : ?>
          <option value="<?= $emp['id_employe'] ?>" <?= (isset($_GET['employe']) && $_GET['employe'] == $emp['id_employe']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($emp['nom']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div>
      <select class="form-select form-select-sm" name="mois" style="min-width: 160px;">
        <option value="">-- Mois --</option>
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <option value="<?= $i ?>" <?= ($_GET['mois'] ?? '') == $i ? 'selected' : '' ?>>
            <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>

    <div>
      <select class="form-select form-select-sm" name="montant" style="min-width: 160px;">
        <option value="">-- Montant --</option>
        <option value="1000" <?= ($_GET['montant'] ?? '') == '1000' ? 'selected' : '' ?>>Moins de 1000</option>
        <option value="1001" <?= ($_GET['montant'] ?? '') == '1001' ? 'selected' : '' ?>>Plus de 1000</option>
      </select>
    </div>

    <div>
      <button type="submit" class="btn btn-sm btn-primary">Filtrer</button>
    </div>

  </form>
</div>


        <!-- CARTES -->
        <div class="row">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h4 class="card-title ">Total par Employé</h4>
                <?php foreach ($employe_stats as $row): ?>
                  <p><?= htmlspecialchars($row['employe']) ?> : <?= $row['total_notes'] ?> notes / <?= $row['total_montant'] ?> MAD</p>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card bg-success text-white">
              <div class="card-body">
                <h4 class="card-title">Total par Mois</h4>
                <?php foreach ($mois_stats as $row): ?>
                  <p><?= $row['mois'] ?> : <?= $row['total_montant'] ?> MAD</p>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="col-md-4 grid-margin stretch-card">
            <div class="card bg-warning text-white">
              <div class="card-body">
                <h4 class="card-title">Total par Catégorie</h4>
                <?php foreach ($type_stats as $row): ?>
                  <p><?= ucfirst($row['type']) ?> : <?= $row['total_par_type'] ?> MAD</p>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- EXPORT -->
        <div class="text-end my-3">
          <a href="export.php?format=excel&mois=<?= $_GET['mois'] ?? '' ?>" class="btn btn-outline-primary me-2">
            <i class="mdi mdi-file-excel"></i> Export Excel
          </a>
          <a href="export.php?format=pdf&mois=<?= $_GET['mois'] ?? '' ?>" class="btn btn-outline-danger">
            <i class="mdi mdi-file-pdf"></i> Export PDF
          </a>
        </div>

      </div> <!-- content-wrapper -->
      <?php include("partials/_footer.php"); ?>
    </div> <!-- main-panel -->
  </div> <!-- page-body-wrapper -->
</div> <!-- container-scroller -->

</body>
