<?php
echo '
<nav>
    <ul class="nav-left">
        <li><a href="login.php">🔑 Login</a></li>
        <li><a href="index.php">📚 Lernen</a></li>
        <li><a href="themen.php">📖 Themen</a></li>
    </ul>

    <ul class="nav-right">
        <li class="dropdown">
            <a href="#" class="dropbtn">👤 Profil</a>
            <div class="dropdown-content">
                <a href="dashboard.php">📊 Fortschritt</a>
                <a href="profile.php">⚙️ Profilverwaltung</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </li>
    </ul>
</nav>
';
?>
