<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$id = $_POST['id'];
$date_frais = mysqli_real_escape_string($conn, $_POST['date_frais']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$montant = mysqli_real_escape_string($conn, $_POST['montant']);


$ancien_justificatif = $_POST['ancien_justificatif'];
$justificatif_noms = [];

// Gérer les nouveaux fichiers
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
    }
}

// Ajouter les anciens justificatifs aux nouveaux
if (!empty($ancien_justificatif)) {
    $justificatif_noms = array_merge(explode(',', $ancien_justificatif), $justificatif_noms);
}

$justificatif_final = implode(',', $justificatif_noms);

// Mettre à jour la base
$sql = "UPDATE notes_frais SET 
        date_frais='$date_frais', 
        type='$type', 
        montant='$montant', 
        justificatif='$justificatif_final' 
        WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Note mise à jour avec succès !'); window.location.href='notefraisE.php';</script>";
} else {
    echo "<script>alert(\"Erreur : " . mysqli_error($conn) . "\");</script>";
}

mysqli_close($conn);
?>
