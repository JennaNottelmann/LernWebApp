let aktuelleFrageIndex = 0;
let fragen = [];

async function ladeFragen() {
    try {
        let response = await fetch("http://localhost/backend/get_fragen.php");
        let data = await response.json();

        if (data.error) {
            document.getElementById("frage").innerText = "❌ Fehler: " + data.error;
            return;
        }

        fragen = data;
        zeigeFrage();
    } catch (error) {
        document.getElementById("frage").innerText = "❌ Fehler beim Laden der Fragen!";
    }
}

function zeigeFrage() {
    if (fragen.length === 0) {
        document.getElementById("frage").innerText = "❌ Keine Fragen in der Datenbank!";
        return;
    }

    if (aktuelleFrageIndex < fragen.length) {
        document.getElementById("frage").innerText = fragen[aktuelleFrageIndex].frage;
        document.getElementById("antwort").value = "";
        document.getElementById("ergebnis").innerText = "";
        document.getElementById("next-card").style.display = "none";
    } else {
        document.getElementById("card-container").innerHTML = "<h2>🎉 Du hast alle Fragen beantwortet!</h2>";
    }
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
    document.getElementById("ergebnis").innerText = result.korrekt === "richtig" 
        ? "✅ Richtig!" 
        : `❌ Falsch! Richtige Antwort: ${result.richtige_antwort}`;

    document.getElementById("next-card").style.display = "block";
}

function naechsteFrage() {
    aktuelleFrageIndex++;
    zeigeFrage();
}

ladeFragen();
