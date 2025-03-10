<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>Dein Lernfortschritt</h1>
    <div id="fortschritt-container">
        <p>Gute Antworten: <span id="richtig">0</span>%</p>
        <p>Falsche Antworten: <span id="falsch">0</span>%</p>
        <p>Teilweise richtig: <span id="teilweise">0</span>%</p>
    </div>
    <script src="dashboard.js"></script>
</body>
</html>
