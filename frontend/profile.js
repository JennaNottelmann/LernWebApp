document.addEventListener("DOMContentLoaded", async function () {
    let response = await fetch("http://localhost/backend/get_profile.php");
    let userData = await response.json();
    document.getElementById("username").innerText = userData.username;
});

document.getElementById("password-form").addEventListener("submit", async function (event) {
    event.preventDefault();
    
    let response = await fetch("http://localhost/backend/update_password.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            old_password: document.getElementById("old-password").value,
            new_password: document.getElementById("new-password").value
        })
    });

    let result = await response.json();
    document.getElementById("status").innerText = result.message;
});
