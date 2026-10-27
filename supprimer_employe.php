<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM employes WHERE id = '$id'";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
header("Location: employeA.php");
exit;
