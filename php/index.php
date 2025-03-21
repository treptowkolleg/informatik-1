<?php

// Einfache All-in-One Musterlösung

// Später werden wir objektorientiert entwickeln. Zum Einstieg reicht dies aber erstmal.
// STICHWORTE: git, Composer, Twig-Engine

// Server starten (im selben Verzeichnis wie diese index.php):
// php -S localhost:3000

session_start();

// Wenn neue Session
if(!isset($_SESSION['login']))
    $_SESSION['login'] = false;

// Wenn Logout angefordert
if(array_key_exists("logout", $_GET))
    logout();

// Wenn Login-Versuch
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $username = strtolower($username);

    $password = $_POST['password'] ?? null;
    if(!login($username, $password))
        $error = "Zugangsdaten sind falsch!";
}



// Check der Zugangsdaten und Login aktivieren
function login($username, $password): bool
{
    // Simulierte Testdatenbank
    $users = [
        ['Max', 'abcd'],
        ['Finn', 'efgh'],
        ['Arne', 'mnop'],
    ];

    foreach ($users as $user) {
        if (
            $username === strtolower($user[0]) &&
            $password === $user[1]
        ) {
            $_SESSION['username'] = ucfirst($user[0]);
            $_SESSION['login'] = true;
            return true;
        }
        return false;
    }
}

// Ausloggen
function logout(): void
{
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Home | Meine Website</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <ul>
                <li><a href="/" class="active">Home</a></li>
            </ul>
            <h1>Home</h1>
        </header>
        <main>
            <?php if(!$_SESSION['login']): ?>
                <h2>Anmelden</h2>
                <h3 style="color: red"><?=$error ?? ''?></h3>
                <form method="post">
                    <label>
                        <span>Benutzername</span>
                        <input type="text" name="username" value="<?=$_POST['username'] ?? '' ?>" placeholder="Benutzername" required>
                    </label>
                    <label>
                        <span>Passwort</span>
                        <input type="password" name="password" value="<?=$_POST['password'] ?? '' ?>" placeholder="Passwort" required>
                    </label>
                    <button type="submit">Login</button>
                </form>
            <?php else: ?>
                <h2>Willkommen, <?=$_SESSION['username']?>!</h2>
                <p>
                    Du kannst dich <a href="?logout">hier wieder ausloggen</a>.
                </p>
            <?php endif; ?>
        </main>
        <footer>
            Erstellt von: Benjamin Wagner.
        </footer>
    </body>
</html>
