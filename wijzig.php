<?php
include_once("connect.php");
$test = require 'connect.php';
$user = 'root';
$password = '';

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$datumEnTijd = date("Y/m/d"). " " . date("h:i:sa");

$nieuweOrdernummer = $_GET['order_nummer'];
$nieuweAfgehandeld = $_GET['afgehandeld'];
$nieuweKlant = $_GET['klant'];
$nieuweOpmerking = $_GET['opmerking'];
$nieuweStatus = $_GET['status'];

if (isset($_POST['submit'])) {
    $nieuweOrdernummer = $_POST['nieuweOrdernummer'];
    $nieuweAfgehandeld = $_POST['nieuweAfgehandeld'];
    $nieuweKlant = $_POST['nieuweKlant'];
    $nieuweOpmerking = $_POST['nieuweOpmerking'];
    $nieuweStatus = $_POST['nieuweStatus'];


    $data = [
        'id' => $_GET['id'],
        'nieuweUpdate' => $datumEnTijd,
        'nieuweOrdernummer' => $nieuweOrdernummer,
        'nieuweAfgehandeld' => $nieuweAfgehandeld,
        'nieuweKlant' => $nieuweKlant,
        'nieuweOpmerking' => $nieuweOpmerking,
        'nieuweStatus' => $nieuweStatus
    ];

    $query = 
    "UPDATE orders SET

    order_nummer=:nieuweOrdernummer,
    afgehandeld=:nieuweAfgehandeld,
    klant=:nieuweKlant,
    opmerking=:nieuweOpmerking,
    `status`=:nieuweStatus,
    `update`=:nieuweUpdate 
    
    WHERE id=:id;";

    $statement = $pdo->prepare($query);
    $statement->execute($data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Wijzig details van bestelling met ID #<?php echo $_GET['id']; ?></h1>
    <h3>Wijzig details van bestelling met ordernummer #<?php echo $nieuweOrdernummer; ?></h3><br><br>

    <p>Terug naar de <a href="orders.php">orders</a></p>

    <form action="" method="post">
            <label for="nieuweOrdernummer"><b>Ordernummer</b></label>
            <input type="text" id="nieuweOrdernummer" name="nieuweOrdernummer"><br><br>
            
            <label for="nieuweAfgehandeld"><b>Afgehandeld?</b><label>
            <input type="text" id="nieuweAfgehandeld" name="nieuweAfgehandeld"><br><br>

            <label for="nieuweKlant"><b>Klant</b><label>
            <input type="text" id="nieuweKlant" name="nieuweKlant"><br><br>

            <label for="nieuweOpmerking"><b>Opmerking:</b><label>
            <input type="text" id="nieuweOpmerking" name="nieuweOpmerking"><br><br>

            <label for="nieuweStatus"><b>Productstatus:</b><label>
            <input type="text" id="nieuweStatus" name="nieuweStatus"><br><br>

            <br><br> 
            <input type="submit" value="Wijzig" name="submit" id="submit">
        </form>
</body>
</html>