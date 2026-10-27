<?php
$title = "Liste des Employés";
include("partials/_head.php");
?>

<body>
  <div class="container-scroller">

    <?php include("partials/_sidebar.php"); ?>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="font-weight-bold">Liste des Employés</h4>
            <a href="ajouter_employe.php" class="btn btn-primary">
              <i class="fas fa-plus"></i> Ajouter
            </a>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom complet</th>
                      <th>Email</th>
                      <th>Rôle</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "gestion_frais");
                    if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

                    $sql = "SELECT * FROM employes";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['id'] . "</td>";
                      echo "<td>" . $row['nom_complet'] . "</td>";
                      echo "<td>" . $row['email'] . "</td>";
                      echo "<td>" . $row['role'] . "</td>";
                      echo "<td>
                              <a href='modifier_employe.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>
                                <i class='fas fa-edit'></i>
                              </a>
                              <a href='supprimer_employe.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Confirmer la suppression ?')\">
                                <i class='fas fa-trash'></i>
                              </a>
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
