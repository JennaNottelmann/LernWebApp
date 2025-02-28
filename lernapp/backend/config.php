<?php
$pdo = new PDO("mysql:host=localhost;dbname=lernapp", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>