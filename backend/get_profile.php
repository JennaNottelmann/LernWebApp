<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["message" => "Nicht eingeloggt"]);
    exit();
}

$stmt = $pdo->prepare("SELECT username FROM benutzer WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);
?>
