<?php
session_start();
// Inclure la connexion à la base de données
include '../config.php';

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID du blog à mettre à jour
    $id_blog_updated = intval($_POST['id']);
    
    // Récupérer les données du blog
    $titreBlog = $_POST['titre-blog-input'];
    $blogContent = $_POST['blog-content'];

    if (empty($titreBlog)) {
        $_SESSION['message_blog'] = "Le titre du blog est requis.";
    }

    if (empty($blogContent)) {
        $_SESSION['message_blog'] = "Le contenu du blog est requis.";
    }

    // Obtenir l'image existante du blog à mettre à jour
    $sql = "SELECT image_path FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_blog_updated);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingImage = $result->fetch_assoc()['image_path'] ?? '';

    // Traiter l'image si un nouveau fichier est soumis
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
            } else {
                // Supprimer l'ancienne image si une nouvelle image est téléchargée
                if (!empty($existingImage) && file_exists($existingImage)) {
                    unlink($existingImage);
                }
            }
        }
    } else {
        // Si aucune nouvelle image n'est soumise, conserver l'ancienne image
        $imagePath = $existingImage;
    }

    // Si aucune erreur, mettre à jour les données dans la base de données
    if (empty($errors)) {
        $sql = "UPDATE blogs SET title = ?, content = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $titreBlog, $blogContent, $imagePath, $id_blog_updated);
        if ($stmt->execute()) {
            $_SESSION['message_blog'] = "Le blog a été mis à jour avec succès.";
            header('Location: ../../../admin/admin-panel.php');
            exit();
        } else {
            $_SESSION['message_blog'] = "Erreur lors de la mise à jour du blog.";
        }
    }

    // Afficher les erreurs s'il y en a
    if (!empty($errors)) {
        $_SESSION['message_blog'] = implode('<br>', $errors);
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
