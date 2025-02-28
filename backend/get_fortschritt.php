<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Nicht eingeloggt"]);
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT f.frage, bf.status 
    FROM benutzer_fortschritt bf
    JOIN fragen f ON bf.frage_id = f.id
    WHERE bf.benutzer_id = ?
");
$stmt->execute([$user_id]);
$fortschritt = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($fortschritt);
?>
