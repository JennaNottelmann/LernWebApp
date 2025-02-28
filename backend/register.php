<?php
require "config.php";
$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$stmt = $pdo->prepare("INSERT INTO benutzer (username, password, bezahlt) VALUES (?, ?, 0)");
$stmt->execute([$username, $password]);

echo json_encode(["message" => "Registrierung erfolgreich! Bitte bezahlen, um Zugang zu erhalten."]);
?>
