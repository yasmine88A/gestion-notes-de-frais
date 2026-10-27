<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    echo 'error';
    exit;
}

$id = intval($_POST['id']);
$statut = $_POST['statut'];

$sql = "UPDATE deplacements SET statut = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'si', $statut, $id);

if (mysqli_stmt_execute($stmt)) {
    echo 'success';
} else {
    echo 'error';
}
?>
