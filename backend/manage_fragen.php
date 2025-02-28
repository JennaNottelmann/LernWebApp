<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["error" => "Keine Berechtigung"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $frage = $data['frage'];
    $antwort = $data['antwort'];
    $kategorie = $data['kategorie'];

    $stmt = $pdo->prepare("INSERT INTO fragen (frage, antwort, kategorie) VALUES (?, ?, ?)");
    $stmt->execute([$frage, $antwort, $kategorie]);

    echo json_encode(["message" => "Frage hinzugefügt"]);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $frage_id = $data['frage_id'];

    $stmt = $pdo->prepare("DELETE FROM fragen WHERE id = ?");
    $stmt->execute([$frage_id]);

    echo json_encode(["message" => "Frage gelöscht"]);
}
?>
