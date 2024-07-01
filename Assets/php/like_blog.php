<?php
session_start();
header('Content-Type: application/json');
include_once 'config.php';

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['blogId']) || !isset($data['liked'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$blogId = intval($data['blogId']);
$liked = $data['liked'] ? 1 : 0;

// Update the likes count
$sql = $liked ? 
    "UPDATE blogs SET likes = likes + 1 WHERE id = ?" : 
    "UPDATE blogs SET likes = likes - 1 WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blogId);

if ($stmt->execute()) {
    // Get the updated likes count
    $result = $conn->query("SELECT likes FROM blogs WHERE id = $blogId");
    $likes = $result->fetch_assoc()['likes'];
    
    echo json_encode(['success' => true, 'likes' => $likes]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update']);
}

$stmt->close();
$conn->close();
?>
