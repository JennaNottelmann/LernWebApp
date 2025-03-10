<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>Registrieren</h1>
    <form id="register-form">
        <input type="text" id="username" placeholder="Benutzername" required>
        <input type="password" id="password" placeholder="Passwort" required>
        <button type="submit">Registrieren</button>
    </form>
    <p id="status"></p>
    <a href="login.php">Bereits registriert? Login</a>
    <script>
        document.getElementById("register-form").addEventListener("submit", async (event) => {
            event.preventDefault();
            
            let response = await fetch("http://localhost/backend/register.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    username: document.getElementById("username").value,
                    password: document.getElementById("password").value
                })
            });

            let result = await response.json();
            document.getElementById("status").innerText = result.message;
        });
    </script>
</body>
</html>