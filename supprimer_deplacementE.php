<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$id = $_GET['id'];
$sql = "DELETE FROM deplacements WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: deplacementE.php");
} else {
    echo "Erreur de suppression : " . mysqli_error($conn);
}
?>
