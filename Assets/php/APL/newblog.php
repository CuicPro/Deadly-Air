<?php
session_start();
// Inclure la connexion à la base de données
include '../config.php';

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérifier et traiter l'image
    if (isset($_FILES['image-input']) && $_FILES['image-input']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image-input']['tmp_name'];
        $imageName = $_FILES['image-input']['name'];
        $imageSize = $_FILES['image-input']['size'];
        $imageType = $_FILES['image-input']['type'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        // Définir les extensions autorisées
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $allowedExtensions)) {
            $_SESSION['message_blog'] = "L'extension de l'image n'est pas autorisée.";
        } else {
            // Déplacer l'image téléchargée dans le répertoire des images
            $uploadDir = '../../../blogUploads/';
            $imageNewName = uniqid() . '.' . $imageExtension;
            $imagePath = $uploadDir . $imageNewName;

            if (!move_uploaded_file($imageTmpPath, $imagePath)) {
                $_SESSION['message_blog'] = "Échec du téléchargement de l'image.";
            }
        }
    } else {
        $_SESSION['message_blog'] = "Veuillez télécharger une image.";
    }

    // Vérifier et traiter le titre et le contenu du blog
    $titreBlog = $_POST['titre-blog-input'];
    $blogContent = $_POST['blog-content'];

    if (empty($titreBlog)) {
        $_SESSION['message_blog'] = "Le titre du blog est requis.";
    }

    if (empty($blogContent)) {
        $_SESSION['message_blog'] = "Le contenu du blog est requis.";
    }

    // Assurer l'absence d'erreurs avant d'insérer les données
    if (empty($_SESSION['message_blog'])) {
        // Formatage de la date en format 'YYYY-MM-DD HH:MM:SS' pour l'insertion
        // La colonne created_at utilisera CURRENT_TIMESTAMP par défaut
        $sql = "INSERT INTO blogs (title, content, image_path, created_at) VALUES (?, ?, ?, DEFAULT)";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$titreBlog, $blogContent, $imagePath])) {
            $_SESSION['message_blog'] = "Le blog a été créé avec succès.";
            header('Location: ../../../admin/admin-panel.php');
            exit();
        } else {
            $_SESSION['message_blog'] = "Erreur lors de l'enregistrement du blog.";
        }
    }
}
?>
