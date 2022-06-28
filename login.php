<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="top">
<img class="logo" src="https://www.harderhoogkarspel.nl/wp-content/uploads/2019/08/hardernatuur.png" alt="Afbeelding niet gevonden">
    <div class="info_button"><svg class="info_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z" fill="rgba(241,196,14,1)"/></svg></div>
</div>
<h1>Login</h1>
<form method="post">
    <div class="user_box">
        <svg class="svg_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15
"><path fill="none" d="M0 0h24v24H0z"/><path d="M3.783 2.826L12 1l8.217 1.826a1 1 0 0 1 .783.976v9.987a6 6 0 0 1-2.672 4.992L12 23l-6.328-4.219A6 6 0 0 1 3 13.79V3.802a1 1 0 0 1 .783-.976zM12 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-4.473 5h8.946a4.5 4.5 0 0 0-8.946 0z" fill="rgba(236,240,241,1)"/></svg>
        <input name="gebruikersnaam" type="text" title="gebruikersnaam" placeholder="Gebruikersnaam" required ">
    </div>
    <div class="wachtwoord_box">
        <svg class="svg_lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15"><path fill="none" d="M0 0h24v24H0z"/><path d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zm-2 0V7a4 4 0 1 0-8 0v1h8zm-5 6v2h2v-2h-2zm-4 0v2h2v-2H7zm8 0v2h2v-2h-2z" fill="rgba(236,240,241,1)"/></svg>
        <input name="wachtwoord" type="password" title="wachtwoord" placeholder="Wachtwoord" required">
    </div>

    <button title="inloggen" class="login" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32"><path fill="none" d="M0 0h24v24H0z"/><path d="M10 11H2.05C2.55 5.947 6.814 2 12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10c-5.185 0-9.449-3.947-9.95-9H10v3l5-4-5-4v3z" fill="rgba(47,204,113,1)"/></svg></button>
</form>
<p>Nog geen account? <a href="registratie.php">Registreer hier</a></p>
</body>
</html>
<?php
error_reporting(0);
session_start();
$host     = 'localhost';
$db       = 'harder_natuursteen';
$user     = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$_SESSION['logged_in'] = false;



$login = FALSE;

$username = $_POST['gebruikersnaam'];
$password = $_POST['wachtwoord'];

$query = 'SELECT * FROM harder_natuursteen.login WHERE (user = :name)';

$values = [':name' => $username];

try
{
    $res = $pdo->prepare($query);
    $res->execute($values);
}
catch (PDOException $e)
{
    echo 'error';
    die();
}

$row = $res->fetch(PDO::FETCH_ASSOC);

if ($username !== $row['user']){
    echo '<div class="alert"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="65" height="65"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z"/></svg><p>gebruikersnaam of wachtwoord is verkeerd</p></div>';
}

if (is_array($row))
{
    if (password_verify($password, $row['password']))
    {
        $login = TRUE;
        $_SESSION['logged_in'] = '';
        $_SESSION['second_key'] = '';
        header("Location: loading.php");
        die();
    }else{echo '<div class="alert"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="65" height="65"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z"/></svg><p>gebruikersnaam of wachtwoord is verkeerd</p></div>';
    }
}

?>


