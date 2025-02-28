<?php
session_start();
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$stmt = $pdo->prepare("SELECT * FROM benutzer WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    if ($user['bezahlt'] == 1 || $user['erstellt_von_admin'] == 1) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        echo json_encode(["message" => "Login erfolgreich!", "role" => $user['role']]);
    } else {
        echo json_encode(["message" => "Bitte bezahlen, um Zugang zu erhalten."]);
    }
} else {
    echo json_encode(["message" => "Login fehlgeschlagen!"]);
}
?>