<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$id = $_POST['id'];
$date_depart = $_POST['date_depart'];
$date_retour = $_POST['date_retour'];
$cout = $_POST['cout'];
$statut = $_POST['statut'];
$lieu = $_POST['lieu'];
$motif = $_POST['motif'];

$sql = "UPDATE deplacements SET date_depart='$date_depart', date_retour='$date_retour', cout='$cout', statut='$statut', lieu='$lieu', motif='$motif' WHERE id=$id";


if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Note mise à jour avec succès !'); window.location.href='deplacementA.php';</script>";
} else {
    echo "<script>alert(\"Erreur : " . mysqli_error($conn) . "\");</script>";
}

mysqli_close($conn);
?>
