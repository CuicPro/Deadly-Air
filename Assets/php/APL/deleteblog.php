<?php
session_start();
include '../config.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: ../../index.html");
    exit();
}

// Vérifiez si le formulaire a été soumis pour supprimer un blog
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Récupérer le chemin de l'image associée au blog
    $stmt = $conn->prepare("SELECT image_path FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    // Supprimer l'image du serveur
    if (!empty($imagePath) && file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Préparer et exécuter la requête pour supprimer le blog
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Si la suppression est réussie, redirigez vers la page du blog avec un message de succès
        $_SESSION['message_blog'] = 'Blog supprimé avec succès.';
    } else {
        // Sinon, redirigez avec un message d'erreur
        $_SESSION['message_blog'] = 'Erreur lors de la suppression du blog.';
    }

    $stmt->close();
    $conn->close();

    header('Location: ../../../admin/admin-panel.php'); // Redirection vers la page des blogs
    exit();
} else {
    // Si la demande n'est pas une suppression de blog, rediriger vers la page des blogs
    header('Location: ../../../index.php');
    exit();
}
?>
