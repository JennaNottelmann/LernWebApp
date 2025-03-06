<?php
$host = "localhost"; // XAMPP verwendet standardmäßig "localhost"
$dbname = "lernwebapp"; // Falls dein Datenbankname anders ist, ändere ihn hier
$username = "root"; // XAMPP Standard-Benutzer
$password = ""; // Standardmäßig kein Passwort

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fehler: Verbindung zur Datenbank fehlgeschlagen! " . $e->getMessage());
}
?>
