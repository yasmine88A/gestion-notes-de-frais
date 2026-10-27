<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "DELETE FROM notes_frais WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: notefraisE.php");
} else {
    echo "Erreur : " . mysqli_error($conn);
}

mysqli_close($conn);
?>
