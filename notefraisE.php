<?php
$title = "Notes de frais - Employé";
include("partials/_head.php");

$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());
?>

<body>
  <div class="container-scroller">
    <!-- Sidebar Employé -->
    <?php include("partials/_sidebar1.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title">Liste  des notes de frais</h4>
            <a href="ajout_noteE.php" class="btn btn-primary">
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
                      $chemin = "uploads/" . $row['justificatif'];

                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['date_frais']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['montant']) . " MAD</td>";

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

                      echo "<td class='d-flex gap-2'>
                              <a href='modifier_noteE.php?id=$id' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a>
                              <a href='supprimer_noteE.php?id=$id' onclick=\"return confirm('Supprimer cette note ?');\" class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
                            </td>";
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
</body>
</html>
