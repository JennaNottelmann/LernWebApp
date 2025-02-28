<?php
require "config.php";
$data = json_decode(file_get_contents("php://input"), true);
$frage_id = $data['frage_id'];
$user_antwort = strtolower(trim($data['antwort']));

$stmt = $pdo->prepare("SELECT antwort FROM fragen WHERE id = ?");
$stmt->execute([$frage_id]);
$correct_answer = strtolower(trim($stmt->fetchColumn()));

$similarity = levenshtein($user_antwort, $correct_answer);
$korrekt = ($similarity <= 2) ? 'richtig' : 'falsch';

$stmt = $pdo->prepare("INSERT INTO benutzer_fortschritt (benutzer_id, frage_id, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?");
$stmt->execute([1, $frage_id, $korrekt, $korrekt]);

echo json_encode(['korrekt' => $korrekt, 'richtige_antwort' => $correct_answer]);
?>
