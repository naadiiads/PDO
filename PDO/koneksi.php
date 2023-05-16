<?php 

$dbServer = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = "db_akses";

try {
    $koneksi = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPass);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $err)
{
echo "Failed koneksiect to Database Server : " . $err->getMessage();
}

?>