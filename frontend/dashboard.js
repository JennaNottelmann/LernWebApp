async function ladeFortschritt() {
    let response = await fetch("http://localhost/backend/get_fortschritt.php");
    let daten = await response.json();

    let total = daten.length;
    let richtig = daten.filter(d => d.status === "richtig").length;
    let falsch = daten.filter(d => d.status === "falsch").length;
    let teilweise = daten.filter(d => d.status === "teilweise").length;

    document.getElementById("richtig").innerText = ((richtig / total) * 100).toFixed(1);
    document.getElementById("falsch").innerText = ((falsch / total) * 100).toFixed(1);
    document.getElementById("teilweise").innerText = ((teilweise / total) * 100).toFixed(1);
}

ladeFortschritt();
