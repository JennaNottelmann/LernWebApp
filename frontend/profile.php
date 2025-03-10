<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>Dein Profil</h1>
    <p><strong>Benutzername:</strong> <span id="username"></span></p>

    <h2>Passwort ändern</h2>
    <form id="password-form">
        <input type="password" id="old-password" placeholder="Altes Passwort" required>
        <input type="password" id="new-password" placeholder="Neues Passwort" required>
        <button type="submit">Passwort ändern</button>
    </form>
    <p id="status"></p>

    <script src="profile.js"></script>
</body>
</html>