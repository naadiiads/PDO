<?php 

include ('koneksi.php'); 

$status = '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['customerNumber'])) {
        $customerNumber_upd = $_GET['customerNumber'];
        $query = $koneksi->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber ");
        $query->bindParam(':customerNumber',$customerNumber_upd);
        if ($query->execute()) {
            $status = 'ok';
        }
        else{
            $status = 'err';
        }
        header('Location: index.php?status='.$status);
    }  
}
?>