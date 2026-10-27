<?php
$title = "Notes de frais";
include("partials/_head.php");


$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());
?>

<body>
  <div class="container-scroller">
    <?php include("partials/_sidebar.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title">Liste des notes de frais</h4>
            <a href="ajout_noteA.php" class="btn btn-primary">
              <i class="fas fa-plus"></i> Ajouter
            </a>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Type</th>
                      <th>Montant</th>
                      <th>Statut</th>
                      <th>Justificatif</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM notes_frais";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      $id = $row['id'];
                      $statut = $row['statut'];
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['date_frais']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['montant']) . " MAD</td>";

                      // Statut avec couleur
                      echo "<td class='statut' data-id='{$id}'>";
                      if ($statut == 'Validé') {
                          echo "<span style='color:green;'>Validé</span>";
                      } elseif ($statut == 'Rejeté') {
                          echo "<span style='color:red;'>Rejeté</span>";
                      } else {
                          echo "<span style='color:orange;'>$statut</span>";
                      }
                      echo "</td>";
                      echo "<td>";
if (!empty($row['justificatif'])) {
    $justificatifs = explode(',', $row['justificatif']);
    foreach ($justificatifs as $fichier) {
        $chemin = "uploads/" . $fichier;
        if (file_exists($chemin)) {
            echo "<a href='$chemin' target='_blank' style='margin-right:5px;'><i class='fas fa-paperclip'></i></a>";
        }
    }
} else {
    echo "<span style='color: grey;'>Aucun</span>";
}
echo "</td>";




                      // Actions
                      echo "<td><div class='d-flex gap-2'>";
                      echo "<a href='modifier_note.php?id=$id' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a>";
                      echo "<a href='supprimer_note.php?id=$id' onclick=\"return confirm('Supprimer cette note ?');\" class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>";

                      if ($statut == 'En attente') {
                          echo "<button class='btn btn-sm btn-success valider' data-id='$id'><i class='fas fa-check-circle'></i></button>";
                          echo "<button class='btn btn-sm btn-secondary rejeter' data-id='$id'><i class='fas fa-times-circle'></i></button>";
                      }

                      echo "</div></td>";
                      echo "</tr>";
                    }

                    mysqli_close($conn);
                    ?>
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
    $('.valider, .rejeter').on('click', function() {
      const id = $(this).data('id');
      const statut = $(this).hasClass('valider') ? 'Validé' : 'Rejeté';

      $.post('changer_sta.php', { id: id, statut: statut }, function(response) {
        if (response === 'success') {
          const cell = $('.statut[data-id="' + id + '"]');
          const couleur = (statut === 'Validé') ? 'green' : 'red';
          cell.html('<span style="color:' + couleur + ';">' + statut + '</span>');
          $('.valider[data-id="' + id + '"], .rejeter[data-id="' + id + '"]').remove();
        } else {
          alert('Erreur lors du changement de statut.');
        }
      });
    });
  });
  </script>
</body>
</html>
