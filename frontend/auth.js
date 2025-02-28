document.getElementById("login-form").addEventListener("submit", async (event) => {
    event.preventDefault();
    
    let response = await fetch("http://localhost/backend/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            username: document.getElementById("username").value,
            password: document.getElementById("password").value
        })
    });

    let result = await response.json();
    document.getElementById("status").innerText = result.message;

    if (result.message === "Login erfolgreich!") {
        window.location.href = "index.html";
    } else if (result.message.includes("bezahlen")) {
        window.location.href = "payment.html";
    }
});
