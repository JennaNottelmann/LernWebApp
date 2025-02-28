<?php
require "config.php";
header("Content-Type: application/json");

$stmt = $pdo->query("SELECT * FROM fragen ORDER BY RAND() LIMIT 10");
$fragen = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($fragen);
?>
