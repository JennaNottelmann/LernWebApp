<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>Login</h1>
    <form id="login-form">
        <input type="text" id="username" placeholder="Benutzername" required>
        <input type="password" id="password" placeholder="Passwort" required>
        <button type="submit">Login</button>
    </form>
    <p id="status"></p>
    <a href="register.php">Noch keinen Account? Registrieren</a>
    <script src="auth.js"></script>
</body>
</html>