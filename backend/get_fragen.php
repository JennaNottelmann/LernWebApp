<?php
require "config.php";
header("Content-Type: application/json");

try {
    $stmt = $pdo->query("SELECT id, frage FROM fragen ORDER BY RAND() LIMIT 10");
    $fragen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($fragen)) {
        echo json_encode(["error" => "Keine Fragen gefunden"]);
    } else {
        echo json_encode($fragen);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Datenbankfehler: " . $e->getMessage()]);
}
?>
