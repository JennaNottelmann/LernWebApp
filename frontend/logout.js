function logout() {
    fetch("../backend/logout.php")
        .then(() => {
            window.location.href = "login.html";
        });
}
