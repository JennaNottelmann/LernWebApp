let aktuelleFrageIndex = 0;
let fragen = [];

async function ladeFragen() {
    let response = await fetch("http://localhost/backend/get_fragen.php");
    fragen = await response.json();
    zeigeFrage();
}

function zeigeFrage() {
    document.getElementById("frage").innerText = fragen[aktuelleFrageIndex].frage;
    document.getElementById("antwort").value = "";
    document.getElementById("ergebnis").innerText = "";
    document.getElementById("next-card").style.display = "none";
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
    if (aktuelleFrageIndex < fragen.length) {
        zeigeFrage();
    } else {
        alert("Du hast alle Fragen beantwortet!");
    }
}

ladeFragen();
