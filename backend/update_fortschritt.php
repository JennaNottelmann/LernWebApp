<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Nicht eingeloggt"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'];
$frage_id = $data['frage_id'];
$status = $data['status']; // "richtig", "falsch" oder "teilweise"

$stmt = $pdo->prepare("
    INSERT INTO benutzer_fortschritt (benutzer_id, frage_id, status) 
    VALUES (?, ?, ?) 
    ON DUPLICATE KEY UPDATE status = ?");
$stmt->execute([$user_id, $frage_id, $status, $status]);

echo json_encode(["message" => "Fortschritt gespeichert"]);
?>
