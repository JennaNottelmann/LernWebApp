<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>Admin Dashboard</h1>

    <h2>Benutzer verwalten</h2>
    <table id="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Benutzername</th>
                <th>Rolle</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <h2>Fragen verwalten</h2>
    <input type="text" id="frage" placeholder="Neue Frage">
    <input type="text" id="antwort" placeholder="Richtige Antwort">
    <button onclick="frageHinzufuegen()">Frage hinzufügen</button>

    <h2>Hochladen von PDFs</h2>
    <input type="file" id="pdfUpload">
    <button onclick="pdfHochladen()">PDF hochladen</button>

    <script src="admin.js"></script>
</body>
</html>
