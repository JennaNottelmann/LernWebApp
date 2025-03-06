<?php
require __DIR__ . '/vendor/autoload.php'; // Guzzle einbinden

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
?>
