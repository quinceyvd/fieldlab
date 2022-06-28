<!DOCTYPE html>
<html lang="en" style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center">
<head>
    <meta charset="UTF-8">
    <title>holdup</title>
    <script>
        function redirect () { setTimeout("go_now()",7000); }
        function go_now ()   { window.location.href = "login.php"; }
    </script>
</head>
<body style="display: grid; justify-content: center; align-items: center; background: #072129; color: #dddddd;" onload="redirect()">
<h1>Access denied!</h1>
<h2>Je bent (nog) niet ingelogd</h2>
<button style="cursor: pointer; background: rebeccapurple; color: #dddddd; border: none; border-radius: 5px; height: 30px; max-width: 200px; margin-left: auto; margin-right: auto" onclick="window.location.href='login.php'">Terug naar login pagina</button>
<p>Na 7 seconde wordt je automatisch terug verwezen naar de login pagina... zo niet klik dan op de bovenstaande knop</p>
</body>
</html>