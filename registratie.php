<?php
error_reporting(0);
session_start();
$host = 'localhost';
$db = 'harder_natuursteen';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = 'SELECT * FROM harder_natuursteen.login WHERE (user = :name)';
if (isset($_POST['status'])) {
    $status = $_POST['status'];
}
if (isset($_POST['gebruikersnaam_registratie'])) {
    $username_reg = $_POST['gebruikersnaam_registratie'];
    $values = [':name' => $username_reg];
}

if (isset($username_reg)) {
    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        echo 'error';
        die();
    }
    $row = $res->fetch(PDO::FETCH_ASSOC);
}


if (isset($_POST['gebruikersnaam_registratie']) && $_POST['gebruikersnaam_registratie'] === $row['user']) {
    echo '<div class="alert"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="65" height="65"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z"/></svg><p>Gebruiker bestaat al</p></div>';
}
if ($_POST['wachtwoord_registratie'] !== $_POST['wachtwoord_registratie_confirm']){
    echo '<div class="alert"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="65" height="65"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z"/></svg><p>Wachtwoorden komen niet overeen</p></div>';
}
else {
    $query = 'INSERT INTO harder_natuursteen.login (user, password, status) VALUES (:name, :passwd, :status)';
    if ($_POST['wachtwoord_registratie'] === $_POST['wachtwoord_registratie_confirm'] && isset($_POST['wachtwoord_registratie'])) {
        $encrypt = password_hash($_POST['wachtwoord_registratie'], PASSWORD_DEFAULT);
        $values = [':name' => $username_reg, ':passwd' => $encrypt, ':status' => $status];
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
            echo '<div class="alert_succes"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="65" height="65"><path fill="none" d="M0 0H24V24H0z"/><path d="M12 1l8.217 1.826c.457.102.783.507.783.976v9.987c0 2.006-1.003 3.88-2.672 4.992L12 23l-6.328-4.219C4.002 17.668 3 15.795 3 13.79V3.802c0-.469.326-.874.783-.976L12 1zm4.452 7.222l-4.95 4.949-2.828-2.828-1.414 1.414L11.503 16l6.364-6.364-1.415-1.414z"/></svg><p>Account is succesvol aangemaakt</p></div>';
        } catch (PDOException $e) {
            echo 'Error query';
            die();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registratie</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="center">
<h1>Registratie</h1>
<form method="post">
    <div class="user_box">
        <svg class="svg_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25
">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path d="M3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM12 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-4.473 5h8.946a4.5 4.5 0 0 0-8.946 0z"
                  fill="rgba(236,240,241,1)"/>
        </svg>
        <input name="gebruikersnaam_registratie" type="text" title="gebruikersnaam" placeholder="Gebruikersnaam"
               required autocomplete="off" ">
    </div>
    <div class="wachtwoord_box">
        <svg class="svg_lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zm-2 0V7a4 4 0 1 0-8 0v1h8zm-5 6v2h2v-2h-2zm-4 0v2h2v-2H7zm8 0v2h2v-2h-2z"
                  fill="rgba(236,240,241,1)"/>
        </svg>
        <input name="wachtwoord_registratie" type="password" title="wachtwoord" placeholder="Wachtwoord" required
               autocomplete="off" ">
    </div>
    <div class="wachtwoord_box_confirm">
        <svg class="svg_lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zm-2 0V7a4 4 0 1 0-8 0v1h8zm-5 6v2h2v-2h-2zm-4 0v2h2v-2H7zm8 0v2h2v-2h-2z"
                  fill="rgba(236,240,241,1)"/>
        </svg>
        <input name="wachtwoord_registratie_confirm" type="password" title="wachtwoord"
               placeholder="Bevestig Wachtwoord" required autocomplete="off" ">
    </div>
    <div class="status_box">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="25" height="25">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path d="M3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM5 4.604v9.185a4 4 0 0 0 1.781 3.328L12 20.597l5.219-3.48A4 4 0 0 0 19 13.79V4.604L12 3.05 5 4.604zM13 10h3l-5 7v-5H8l5-7v5z"
                  fill="rgba(255,255,255,1)"/>
        </svg>
        <select name="status" class="status" required>
            <option value="Kantoor">Kantoor</option>
            <option value="Productie">Productie</option>
            <option value="Admin">Admin</option>
        </select>
    </div>

    <button title="inloggen" class="login" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="40" height="40">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path d="M10 11H2.05C2.55 5.947 6.814 2 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10c-5.185 0-9.449-3.947-9.95-9H10v3l5-4-5-4v3z"
                  fill="rgba(47,204,113,1)"/>
        </svg>
    </button>
</form>
<p>Heb je al een account? <a href="login.php">Login</a></p>
</div>
</body>
</html>