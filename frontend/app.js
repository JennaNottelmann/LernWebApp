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

    let response = await fetch("http://localhost/LernWebApp/backend/check_antwort_ki.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ antwort: userAntwort, richtige_antwort: richtigeAntwort })
    });

    let result = await response.json();
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