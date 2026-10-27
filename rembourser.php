<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

if (!empty($_POST['rembourser'])) {
    foreach ($_POST['rembourser'] as $id) {
        $id = intval($id);
        $sql = "UPDATE notes_frais SET statut = 'Remboursée' WHERE id = $id";
        mysqli_query($conn, $sql);
    }
}

// Redirection avec le filtre de recherche conservé
$recherche = isset($_POST['recherche_post']) ? urlencode($_POST['recherche_post']) : '';
header("Location: comptable.php?recherche=$recherche");
exit();
?>
