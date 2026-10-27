<?php
$title = "Liste des Déplacements";
include("partials/_head.php");
?>

<body>
  <div class="container-scroller">
    
    <?php include("partials/_sidebar.php"); ?>
    
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title">Liste des Déplacements</h4>
            <a href="ajout_deplacement.php" class="btn btn-primary">
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
                      <th>Statut</th>
                      <th>Lieu</th>
                      <th>Motif</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "gestion_frais");
                    if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());
                    $sql = "SELECT * FROM deplacements";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                      <td><?= htmlspecialchars($row['date_depart']) ?></td>
                      <td><?= htmlspecialchars($row['date_retour']) ?></td>
                      <td><?= htmlspecialchars($row['cout']) ?> MAD</td>
                      <td class="statut" data-id="<?= $row['id'] ?>">
                        <?php
                        if ($row["statut"] == "Validé") {
                            echo "<span style='color:green;'>Validé</span>";
                        } elseif ($row["statut"] == "Rejeté") {
                            echo "<span style='color:red;'>Rejeté</span>";
                        } else {
                            echo "<span style='color:orange;'>En attente</span>";
                        }
                        ?>
                      </td>
                      <td><?= htmlspecialchars($row['lieu']) ?></td>
                      <td><?= htmlspecialchars($row['motif']) ?></td>
                      <td>
                        <div class="d-flex gap-2">
                          <a href='modifier_deplacement.php?id=<?= $row["id"] ?>' class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href='supprimer_deplacement.php?id=<?= $row["id"] ?>' onclick="return confirm('Supprimer ce déplacement ?')" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                          <?php if ($row["statut"] == "En attente"): ?>
                            <button class="btn btn-sm btn-success valider-deplacement" data-id="<?= $row['id'] ?>">
                              <i class="fas fa-check-circle"></i>
                            </button>
                            <button class="btn btn-sm btn-secondary rejeter-deplacement" data-id="<?= $row['id'] ?>">
                              <i class="fas fa-times-circle"></i>
                            </button>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php mysqli_close($conn); ?>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function() {
    $('.valider-deplacement, .rejeter-deplacement').on('click', function() {
      const id = $(this).data('id');
      const statut = $(this).hasClass('valider-deplacement') ? 'Validé' : 'Rejeté';

      $.post('changer_statut_deplacement.php', { id: id, statut: statut }, function(response) {
        if (response === 'success') {
          const cell = $('.statut[data-id="' + id + '"]');
          const couleur = (statut === 'Validé') ? 'green' : 'red';
          cell.html('<span style="color:' + couleur + ';">' + statut + '</span>');
          $('button[data-id="' + id + '"]').remove(); // Supprime les boutons
        } else {
          alert("Erreur lors de la mise à jour.");
        }
      });
    });
  });
  </script>
</body>
</html>
