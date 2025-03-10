<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

// 🛠️ Debugging: Prüfen, ob POST-Daten ankommen
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Methode nicht erlaubt, bitte POST verwenden"]);
    exit;
}

$userAntwort = $_POST['antwort'] ?? "";
$richtigeAntwort = $_POST['richtige_antwort'] ?? "";

// 🛠️ Debugging: Prüfe, ob Daten leer sind
if (empty($userAntwort) || empty($richtigeAntwort)) {
    echo json_encode(["error" => "Fehlende Daten", "empfangen" => $_POST]);
    exit;
}

// 🛠️ Debugging: Prüfe, ob der OpenAI-API-Request fehlschlägt
try {
    require __DIR__ . '/../vendor/autoload.php'; // Guzzle laden
    use GuzzleHttp\Client;
    
    $api_key = "DEIN_OPENAI_API_KEY";
    $client = new Client();

    $prompt = "Vergleiche die Benutzerantwort mit der korrekten Antwort:\n\n";
    $prompt .= "Korrekte Antwort: \"$richtigeAntwort\"\n";
    $prompt .= "Benutzerantwort: \"$userAntwort\"\n";
    $prompt .= "Antworte nur mit 'Ja' oder 'Nein'.";

    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => "Bearer $api_key",
            'Content-Type'  => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'Du bist ein Lehrer, der Antworten bewertet.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 10
        ]
    ]);

    $data = json_decode($response->getBody(), true);
    $antwort = strtolower(trim($data['choices'][0]['message']['content']));

    if (strpos($antwort, "ja") !== false) {
        echo json_encode(["korrekt" => "richtig"]);
    } else {
        echo json_encode(["korrekt" => "falsch", "richtige_antwort" => $richtigeAntwort]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Fehler beim KI-Check: " . $e->getMessage()]);
}


require __DIR__ . '/../vendor/autoload.php'; // Guzzle einbinden

use GuzzleHttp\Client;

header("Content-Type: application/json");

$api_key = "DEIN_OPENAI_API_KEY"; // Ersetze das mit deinem OpenAI-Schlüssel
$client = new Client();

$userAntwort = $_POST['antwort'] ?? "";
$richtigeAntwort = $_POST['richtige_antwort'] ?? "";

// Falls eine der Eingaben fehlt, Fehler zurückgeben
if (empty($userAntwort) || empty($richtigeAntwort)) {
    echo json_encode(["error" => "Fehlende Daten"]);
    exit;
}

// KI-Prompt für die Antwortbewertung
$prompt = "Beurteile, ob die folgende Benutzerantwort der korrekten Antwort entspricht:\n\n";
$prompt .= "Korrekte Antwort: \"$richtigeAntwort\"\n";
$prompt .= "Benutzerantwort: \"$userAntwort\"\n";
$prompt .= "Antworte nur mit 'Ja' oder 'Nein'.";

try {
    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => "Bearer $api_key",
            'Content-Type'  => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'Du bist ein Lehrer, der Antworten bewertet.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 10
        ]
    ]);

    $data = json_decode($response->getBody(), true);
    $antwort = strtolower(trim($data['choices'][0]['message']['content']));

    if (strpos($antwort, "ja") !== false) {
        echo json_encode(["korrekt" => "richtig"]);
    } else {
        echo json_encode(["korrekt" => "falsch", "richtige_antwort" => $richtigeAntwort]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Fehler beim KI-Check: " . $e->getMessage()]);
}



error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php'; // Guzzle einbinden

///use GuzzleHttp\Client;

header("Content-Type: application/json");

$api_key = "DEIN_OPENAI_API_KEY";

// 🛠️ Debugging: Prüfen, ob POST-Daten vorhanden sind
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Methode nicht erlaubt, bitte POST verwenden"]);
    exit;
}

$userAntwort = $_POST['antwort'] ?? "";
$richtigeAntwort = $_POST['richtige_antwort'] ?? "";

// 🛠️ Debugging: Logge empfangene Daten
file_put_contents("debug.log", "User: $userAntwort | Richtig: $richtigeAntwort\n", FILE_APPEND);

if (empty($userAntwort) || empty($richtigeAntwort)) {
    echo json_encode(["error" => "Fehlende Daten", "empfangen" => $_POST]);
    exit;
}

// GPT-4 Anfrage erstellen
$client = new Client();
$prompt = "Vergleiche die Benutzerantwort mit der korrekten Antwort:\n\n";
$prompt .= "Korrekte Antwort: \"$richtigeAntwort\"\n";
$prompt .= "Benutzerantwort: \"$userAntwort\"\n";
$prompt .= "Antworte nur mit 'Ja' oder 'Nein'.";

try {
    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => "Bearer $api_key",
            'Content-Type'  => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'Du bist ein Lehrer, der Antworten bewertet.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 10
        ]
    ]);

    $data = json_decode($response->getBody(), true);
    $antwort = strtolower(trim($data['choices'][0]['message']['content']));

    if (strpos($antwort, "ja") !== false) {
        echo json_encode(["korrekt" => "richtig"]);
    } else {
        echo json_encode(["korrekt" => "falsch", "richtige_antwort" => $richtigeAntwort]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Fehler beim KI-Check: " . $e->getMessage()]);
}
?>

