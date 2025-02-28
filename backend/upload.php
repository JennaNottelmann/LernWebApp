<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["error" => "Keine Berechtigung"]);
    exit();
}

$upload_dir = "../uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {
    $file_name = basename($_FILES['pdf']['name']);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $file_path)) {
        echo json_encode(["message" => "PDF erfolgreich hochgeladen"]);
    } else {
        echo json_encode(["error" => "Fehler beim Hochladen"]);
    }
} else {
    echo json_encode(["error" => "Keine Datei erhalten"]);
}
?>
