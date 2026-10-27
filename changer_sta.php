<?php
// Connexion à la base
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    echo "error";
    exit;
}

// Vérifier si les données sont bien envoyées
if (isset($_POST['id']) && isset($_POST['statut'])) {
    $id = intval($_POST['id']);
    $statut = $_POST['statut'];

    // Vérifier que le statut est correct
    if (in_array($statut, ['Validé', 'Rejeté'])) {
        $sql = "UPDATE notes_frais SET statut = '$statut' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "invalid_statut";
    }
} else {
    echo "missing_data";
}

// Fermer la connexion
mysqli_close($conn);
?>
