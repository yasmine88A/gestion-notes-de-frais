<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$id = $_POST['id'];
$date_depart = $_POST['date_depart'];
$date_retour = $_POST['date_retour'];
$cout = $_POST['cout'];
$reglement = $_POST['reglement'];
$lieu = $_POST['lieu'];
$motif = $_POST['motif'];

$sql = "UPDATE deplacements SET date_depart='$date_depart', date_retour='$date_retour', cout='$cout', reglement='$reglement', lieu='$lieu', motif='$motif' WHERE id=$id";


if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Note mise à jour avec succès !'); window.location.href='deplacementE.php';</script>";
} else {
    echo "<script>alert(\"Erreur : " . mysqli_error($conn) . "\");</script>";
}

mysqli_close($conn);
?>
