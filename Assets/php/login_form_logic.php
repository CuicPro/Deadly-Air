<?php
session_start();
require '../../vendor/autoload.php'; // Charger Composer autoload
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $email);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $verification_code = md5(rand());
            $stmt = $conn->prepare("UPDATE users SET verification_code = ? WHERE id = ?");
            $stmt->bind_param("si", $verification_code, $id);
            $stmt->execute();
            $verification_link = "http://localhost/cuic/DeadlyAir/Deadly-Air/Assets/php/verify_email.php?code=$verification_code";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'hacked.storm.pro@gmail.com'; // Remplacez par votre adresse email
                $mail->Password = $mdp_smtp; // Remplacez par votre mot de passe email
                $mail->SMTPSecure = PHPMAILER::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('no-reply@deadlyaire.com', 'Deadly Air Local Login verify');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body = "Click on this link to verify your email: <a href='$verification_link'>$verification_link</a>";
                
                $mail->send();
                $_SESSION['user_id'] = $id;
                header("Location: verify_prompt.php");
                exit();
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username.";
    }
}
?>
