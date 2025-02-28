<?php
session_start();
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$old_password = $data['old_password'];
$new_password = password_hash($data['new_password'], PASSWORD_BCRYPT);

$stmt = $pdo->prepare("SELECT password FROM benutzer WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!password_verify($old_password, $user['password'])) {
    echo json_encode(["message" => "Altes Passwort falsch"]);
    exit();
}

$stmt = $pdo->prepare("UPDATE benutzer SET password = ? WHERE id = ?");
$stmt->execute([$new_password, $_SESSION['user_id']]);

echo json_encode(["message" => "Passwort erfolgreich geändert"]);
?>
