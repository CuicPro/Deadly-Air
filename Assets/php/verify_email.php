<?php
session_start();
include 'config.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Préparez la requête pour sélectionner l'id et le username où le code de vérification correspond
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE verification_code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->store_result();
    
    // Vérifiez s'il y a des résultats
    if ($stmt->num_rows > 0) {
        // Lie les résultats des colonnes aux variables
        $stmt->bind_result($id, $username);
        $stmt->fetch();
        
        // Met à jour la table des utilisateurs pour réinitialiser le code de vérification
        $update_stmt = $conn->prepare("UPDATE users SET verification_code = NULL WHERE id = ?");
        $update_stmt->bind_param("i", $id);
        $update_stmt->execute();
        
        // Enregistre le nom d'utilisateur dans la session
        $_SESSION['username'] = $username;
        header("Location: ../../admin/admin-panel.php");
        exit();
    } else {
        echo "Invalid verification code.";
    }
} else {
    echo "No verification code provided.";
}
?>
