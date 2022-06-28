<?php
session_start();
include_once("connect.php");
$test = require 'connect.php';
$user = 'root';
function connect($host, $db, $user, $password)
{
    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
    try {
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
return new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
die($e->getMessage());
}
}
if (isset($_SESSION['logged_in'])){echo '';}
else {header("Location: login.php");}
if (!isset($_SESSION['logged_in'],$_SESSION['second_key'],$_SESSION['backup_key'])){header("Location: holdup.php");}
?>
<!doctype html>
<html lang="en" style="overflow: auto;overflow-x: hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestellingen</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script src="java.js"></script> -->
</head>
<body style="overflow-x:hidden;margin: auto">

<div class="top">
    <img class="logo" src="hardernatuur-very_compressed-scale-1_00x-gigapixel.png" alt="afbeelding niet gevonden">
    <button type="button" class="log_out" onclick="location.href='uitlog.php'"><svg class="logout_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2a9.985 9.985 0 0 1 8 4h-2.71a8 8 0 1 0 .001 12h2.71A9.985 9.985 0 0 1 12 22zm7-6v-3h-8v-2h8V8l5 4-5 4z" fill="rgba(241,196,14,1)"/></svg></button>
</div>

<h1 class="title_orders">Bestellingen</h1>

<?php
    require 'connect.php';
    $sql = "SELECT * FROM harder_natuursteen.orders";
    $GLOBALS['pdo'] = $pdo = new PDO($dsn, $user, $password);
    $stmt = $GLOBALS['pdo']->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
<div class="wrapper">
<table id="orders" border="0">
    <thead>
    <tr>
        <th><h3 align="center">Klant:</h3></th>
        <td><h3 align="center"><?php echo htmlspecialchars($row['klant']); ?></h3></td><br>
        <hr>
    </tr>
    </thead>
    </table>
    <table>
        <tr>
        <th><p>Ordernummer</p></th>
        <td><p class="whitetext"><?php echo htmlspecialchars($row['order_nummer']); ?></p></td>
    </tr>
    <tr>
        <th><p>Aanmaakdatum</p></th>
        <td><p class="whitetext"><?php echo htmlspecialchars($row['aanmaak']); ?></p></td>
    </tr>
    <tr>
        <th><p>Opmerking</p></th>
        <td><p class="whitetext"><?php echo htmlspecialchars($row['opmerking']); ?></p></td>
    </tr>
    <tr>
        <th><p>Status</p></th>
        <td><p class="whitetext"><?php echo htmlspecialchars($row['status']); ?></p></td>
    </tr>
    <tr>
        <th><p>Laatste update</p></th>
        <td><p class="whitetext"><?php echo htmlspecialchars($row['update']); ?></p></td>
    </tr>
    <tr>
        <th><p>Afgehandeld</p></th>
        <td><p class="whitetext"><?php echo htmlspecialchars($row['afgehandeld']); ?></p></td>
    </tr>
    </table>
    <table>
    <tbody>
        <tr>
            <td>
                
            <button type="submit" value="verwijder" name="delbtn" style="color: #707b8c" class='delbtn'
                         data-pid=<?php echo $row['id']; ?>><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0H24V24H0z"/><path d="M20 5c.552 0 1 .448 1 1v6c0 .552-.448 1-1 1 .628.835 1 1.874 1 3 0 2.761-2.239 5-5
                         5s-5-2.239-5-5c0-1.126.372-2.165 1-3H4c-.552 0-1-.448-1-1V6c0-.552.448-1 1-1h16zm-7 10v2h6v-2h-6zm6-8H5v4h14V7z" fill="rgba(255,0,0,1)"/></svg></button></td>
            <td>
        <td><form method='get' action='wijzig.php'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['order_nummer']); ?>' name='order_nummer'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['id']); ?>' name='id'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['afgehandeld']); ?>' name='afgehandeld'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['klant']); ?>' name='klant'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['opmerking']); ?>' name='opmerking'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['status']); ?>' name='status'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['aanmaak']); ?>' name='aanmaak'>
                    <input type='hidden' value='<?php echo htmlspecialchars($row['update']); ?>' name='update'>
                    <input type='submit' value='Wijzig details' class="submitBttn">
                </form></td>
        
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</wrapper>
<br><br>

<form action="" method="post">
    <input type="submit" name="add_row" class="add_row" value="Order toevoegen" />
</form>

<br>
<?php
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_row']))
{
    add();
}

function add()
{include "connect.php";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO harder_natuursteen.orders (order_nummer, aanmaak, afgehandeld, klant, opmerking, status, `update`)
VALUES (null, DEFAULT, null, null, null, null, DEFAULT);";
        $conn->exec($sql);
        echo "<script>window.location.href='orders.php'</script>";
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    die();
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>$('.delbtn').on( 'click', function del(){
        if(confirm('Eenmaal bevestigd kan deze actie niet ongedaan worden gemaakt!')){
            const pid = $(this).data('pid');
            $.post( "delete.php", { pid: pid })
            setTimeout(function(){
                        window.location.reload();
                    }, 500);

        }
    });
    
    var modal = document.getElementById("modal");

    $('.edit').on('click', function open(){
       modal.style.display = "block"; 
    });
    
    
    $('.close').on('click', function close(){
       modal.style.display = "none"; 
    });
</script>
</body>
</html>

