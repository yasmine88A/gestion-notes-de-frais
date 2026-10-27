<?php
$title = "Notes de frais validées / remboursées";
include("partials/_head.php");
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$filtre = "";
if (!empty($_GET['recherche'])) {
    $recherche = mysqli_real_escape_string($conn, $_GET['recherche']);
    $filtre = " AND (nf.type LIKE '%$recherche%' OR nf.statut LIKE '%$recherche%')";
}

// Requête pour récupérer les notes validées/remboursées
$sql = "SELECT nf.id, nf.date_frais, nf.type, nf.montant, nf.statut, nf.justificatif
        FROM notes_frais nf
        WHERE nf.statut IN ('Validé', 'Remboursée') $filtre";

$result = mysqli_query($conn, $sql);
?>


<body>
  <div class="container-scroller">
    
    <!-- Sidebar -->
    <?php include("partials/_sidebar3.php"); ?>
    
    <div class="container-fluid page-body-wrapper">

    

      <!-- Contenu principal -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Notes de frais validées / remboursées </h3>
          </div>

          <!-- Recherche -->
          <div class="row mb-3">
            <div class="col-md-6">
              <form method="GET" action="comptable.php" class="d-flex">
                
                <input type="text" name="recherche" class="form-control" placeholder="Rechercher par type ou statut..." 
                       value="<?= isset($_GET['recherche']) ? htmlspecialchars($_GET['recherche']) : '' ?>">
                <button type="submit" class="btn btn-primary ms-2"><i class="mdi mdi-magnify"></i></button>
              </form>
            </div>
          </div>

          <!-- Tableau -->
          <form method="POST" action="rembourser.php">
            <input type="hidden" name="recherche_post" value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>">

            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Liste des notes</h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Justificatif</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                      <tr>
                        <td><input type="checkbox" name="rembourser[]" value="<?= $row['id'] ?>"></td>
                        <td><?= htmlspecialchars($row['date_frais']) ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><?= htmlspecialchars($row['montant']) ?> MAD</td>
                        <td>
                          <?php if ($row['statut'] == 'Validé') : ?>
                            <span class="badge bg-success">Validée</span>
                          <?php else : ?>
                            <span class="badge bg-info ">Remboursée</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php
                           if (!empty($row['justificatif'])) {
    $fichiers = explode(',', $row['justificatif']);
    foreach ($fichiers as $fichier) {
        $chemin = "uploads/" . trim($fichier);
        if (file_exists($chemin)) {
            echo "<a href='$chemin' target='_blank' class='me-1'><i class='mdi mdi-paperclip'></i></a>";
        }
    }
} else {
    echo "<span class='text-muted'>Aucun</span>";
}

                          ?>
                        </td>
                      </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>

                <div class="mt-3">
                  <button type="submit" class="btn btn-outline-primary">
                    <i class="mdi mdi-cash-refund"></i> Rembourser
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Footer -->
        <?php include("partials/_footer.php"); ?>
      </div>
    </div>
  </div>
</body>
</html>

<?php mysqli_close($conn); ?>
