<?php
require "config.php";
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];

$stmt = $pdo->prepare("UPDATE benutzer SET bezahlt = 1 WHERE username = ?");
$stmt->execute([$username]);

echo json_encode(["message" => "Zahlung erfolgreich! Zugang freigeschaltet."]);
?>