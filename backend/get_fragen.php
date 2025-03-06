<?php
header("Content-Type: application/json");
$servername = "localhost";
$username = "root"; // Falls du XAMPP nutzt
$password = ""; // Standardmäßig leer in XAMPP
$dbname = "LernWebApp";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Prüfen, ob die Verbindung erfolgreich ist
if ($conn->connect_error) {
    die(json_encode(["error" => "Datenbankverbindung fehlgeschlagen: " . $conn->connect_error]));
}

// SQL-Abfrage für Fragen
$sql = "SELECT id, frage, antwort FROM fragen";
$result = $conn->query($sql);

$fragen = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fragen[] = $row;
    }
} else {
    die(json_encode(["error" => "Keine Fragen in der Datenbank gefunden."]));
}

// JSON-Antwort zurückgeben
echo json_encode($fragen);
$conn->close();
?>
