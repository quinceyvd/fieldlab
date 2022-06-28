<?php
session_start();
if (isset($_SESSION['logged_in'], $_SESSION['second_key'])){
    $_SESSION['backup_key'] = '';
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laden..</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function redirect () { setTimeout("go_now()",5000); }
        function go_now ()   { window.location.href = "orders.php"; }
    </script>
</head>
<body onload="redirect()">
<h1 class="loading_text">Een moment geduld aub..</h1>
<div class="head">
    <div class="circle"></div>
    <div class="pulse"></div>
</div>
</body>
</html>