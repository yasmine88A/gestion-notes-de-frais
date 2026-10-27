<?php
$title = "Mes Déplacements";
include("partials/_head.php");

$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$sql = "SELECT * FROM deplacements";
$result = mysqli_query($conn, $sql);
?>

<body>
  <div class="container-scroller">
    <!-- Sidebar Employé -->
    <?php include("partials/_sidebar1.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title"> Liste des Déplacements</h4>
            <a href="ajout_deplacementE.php" class="btn btn-primary">
              <i class="fas fa-plus"></i> Ajouter
            </a>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Date Départ</th>
                      <th>Date Retour</th>
                      <th>Coût</th>
                      <th>Règlement</th>
                      <th>Lieu</th>
                      <th>Motif</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?= htmlspecialchars($row['date_depart']) ?></td>
                        <td><?= htmlspecialchars($row['date_retour']) ?></td>
                        <td><?= htmlspecialchars($row['cout']) ?> MAD</td>
                        <td>
                          <?php
                            if ($row["reglement"] == "Remboursement") {
                                echo "<span style='color:green;'>Remboursement</span>";
                            } elseif ($row["reglement"] == "Avance") {
                                echo "<span style='color:red;'>Avance</span>";
                            }
                          ?>
                        </td>
                        <td><?= htmlspecialchars($row['lieu']) ?></td>
                        <td><?= htmlspecialchars($row['motif']) ?></td>
                        <td class="d-flex gap-2">
                          <a href='modifier_deplacementE.php?id=<?= $row["id"] ?>' class='btn btn-sm btn-warning'><i class="fas fa-edit"></i></a>
                          <a href='supprimer_deplacementE.php?id=<?= $row["id"] ?>' onclick="return confirm('Supprimer ce déplacement ?')" class='btn btn-sm btn-danger'><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include("partials/_footer.php"); ?>
</body>
</html>

<?php mysqli_close($conn); ?>
