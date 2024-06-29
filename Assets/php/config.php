<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deadlyair";
$mdp_smtp = "crnyuclfmyalhffa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>