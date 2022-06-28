<?php
$username  = 'root';
$password  = '';
try {
    $dbconn = new PDO('mysql:host=localhost;dbname=harder_natuursteen', $username, $password);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$result = 0;
echo $id = (int)$_POST['pid'];

if((int)$id){
    $stmtDelete = $dbconn->prepare("DELETE FROM harder_natuursteen.orders WHERE id = :id");
    $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
    if($stmtDelete->execute()){
        $result = 1;
    }
}
echo $result;
$dbconn = null;
// onclick svg laat stmt aanpassen aan svg zodat de juiste table onderdelen kunnen worden verwijderd zonder id.