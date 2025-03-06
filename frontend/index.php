<?php
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lernkarten - AP1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <h1>AP1 Lernkarten</h1>
    
    <div id="card-container">
        <div id="card">
            <p id="frage">Lade Frage...</p>
            <input type="text" id="antwort" placeholder="Deine Antwort">
            <button onclick="pruefeAntwort()">Überprüfen</button>
            <p id="ergebnis"></p>
        </div>
    </div>

    <button id="next-card" style="display:none;" onclick="naechsteFrage()">Nächste Frage</button>

    <script src="app.js"></script>
</body>
</html>
?>

