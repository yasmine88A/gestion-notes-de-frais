<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gestion_frais");

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $mot_de_passe = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM users WHERE nom = '$nom' AND mot_de_passe = '$mot_de_passe'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['nom'] = $user['nom']; 
     
        $_SESSION['role'] = $user['role'];  // Assure-toi que la colonne s'appelle bien "rôle"
   


        // Redirection selon le rôle
        if ($user['role'] == 'admin') {
            header("Location: notefraisA.php");
        } elseif ($user['role'] == 'comptable') {
            header("Location: comptable.php");
        } else {
            header("Location: notefraisE.php");
        }
        exit();
    } else {
        echo "<script>alert('Nom ou mot de passe incorrect'); window.history.back();</script>";
    }
}

mysqli_close($conn);
?>
