<?php
session_start();
unset($_SESSION['logged_in'], $_SESSION['second_key'], $_SESSION['backup_key']);
session_destroy();
?>
<!doctype html>
<html lang="en">
<head style="display: flex; justify-content: center; align-items: center; text-align: center;">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>logged out</title>
    <style>* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body style="height: 100vh; width: 100vw; overflow: hidden; background: #111828; color: #dddddd; position: absolute; top: 40%;">
<h1 style="margin: auto; text-align: center;">Uitgelogd</h1>
<button style=" display: block; align-items: center; justify-content: center; cursor: pointer; background: rebeccapurple; color: #dddddd; border: none; border-radius: 5px; height: 50px; width: 250px; margin-left: auto; margin-right: auto; margin-top: 3rem;" onclick="window.location.href='login.php'">terug naar login pagina</button>