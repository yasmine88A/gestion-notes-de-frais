<?php
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) {
    die("Erreur : " . mysqli_connect_error());
}

if (isset($_POST['id']) && isset($_POST['nom_complet']) && isset($_POST['email']) && isset($_POST['role'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom_complet']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE employes SET nom_complet='$nom', email='$email', role='$role' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Employé mis à jour avec succès !'); window.location.href='employeA.php';</script>";
    } else {
        echo "<script>alert(\"Erreur : " . mysqli_error($conn) . "\");</script>";
    }

} else {
    echo "<script>alert('Données manquantes dans le formulaire.'); window.location.href='employeA.php';</script>";
}

mysqli_close($conn);
?>
