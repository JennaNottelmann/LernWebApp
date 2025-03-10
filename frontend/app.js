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
?>

let aktuelleFrageIndex = 0;
let fragen = [];

async function ladeFragen() {
    try {
        let response = await fetch("http://localhost/LernWebApp/backend/get_fragen.php");
        console.log("Antwort von API:", response);

        let data = await response.json();
        console.log("Erhaltene Daten:", data); // Hier siehst du die Fragen

        if (!Array.isArray(data) || data.length === 0) {
            console.error("❌ Keine Fragen erhalten oder falsches Format:", data);
            document.getElementById("frage").innerText = "❌ Keine Fragen gefunden!";
            return;
        }

        fragen = data;
        console.log("Gespeicherte Fragen:", fragen);
        zeigeFrage();
    } catch (error) {
        console.error("Fehler beim Abrufen der Fragen:", error);
        document.getElementById("frage").innerText = "❌ Fehler beim Laden der Fragen!";
    }
}


function zeigeFrage() {
    console.log("Frage anzeigen, Index:", aktuelleFrageIndex);

    if (aktuelleFrageIndex >= fragen.length) {
        document.getElementById("card-container").innerHTML = "<h2>🎉 Du hast alle Fragen beantwortet!</h2>";
        document.getElementById("next-card").style.display = "none"; // Button ausblenden
        return;
    }

    document.getElementById("frage").innerText = fragen[aktuelleFrageIndex].frage;
    document.getElementById("antwort").value = "";
    document.getElementById("ergebnis").innerText = "";
    document.getElementById("next-card").style.display = "block"; // Button anzeigen
}


async function pruefeAntwort() {
    let userAntwort = document.getElementById("antwort").value;
    let frageId = fragen[aktuelleFrageIndex].id;
    let richtigeAntwort = fragen[aktuelleFrageIndex].antwort;

    console.log("Sende Anfrage mit:", userAntwort, richtigeAntwort);

    let response = await fetch("http://localhost/LernWebApp/backend/check_antwort_ki.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ antwort: userAntwort, richtige_antwort: richtigeAntwort })
    });

    let result = await response.json();
    console.log("Antwort von API:", result);

    document.getElementById("ergebnis").innerText = result.korrekt === "richtig" ?
        "✅ Richtig!" :
        `❌ Falsch! Richtige Antwort: ${result.richtige_antwort}`;
}




function naechsteFrage() {
    console.log("Button wurde geklickt!"); // Debugging

    aktuelleFrageIndex++; // Zähler erhöhen
    console.log("Neuer Frageindex:", aktuelleFrageIndex); // Debugging

    zeigeFrage(); // Nächste Frage anzeigen
}


ladeFragen();