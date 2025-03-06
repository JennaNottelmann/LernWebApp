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
    console.log("Aufruf von zeigeFrage(), Fragen-Array:", fragen);

    if (!fragen || fragen.length === 0) {
        document.getElementById("frage").innerText = "❌ Keine Fragen in der Datenbank!";
        return;
    }

    document.getElementById("frage").innerText = fragen[0].frage;
}


async function pruefeAntwort() {
    let userAntwort = document.getElementById("antwort").value;
    let frageId = fragen[aktuelleFrageIndex].id;

    let response = await fetch("http://localhost/backend/check_antwort.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ frage_id: frageId, antwort: userAntwort })
    });

    let result = await response.json();
    document.getElementById("ergebnis").innerText = result.korrekt === "richtig" ?
        "✅ Richtig!" :
        `❌ Falsch! Richtige Antwort: ${result.richtige_antwort}`;

    document.getElementById("next-card").style.display = "block";
}

function naechsteFrage() {
    aktuelleFrageIndex++;
    zeigeFrage();
}

ladeFragen();