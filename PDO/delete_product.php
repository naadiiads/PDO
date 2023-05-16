<?php 

include ('koneksi.php'); 

$status = '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['productCode'])) {
        $productCode_upd = $_GET['productCode'];
        $query = $koneksi->prepare("DELETE FROM products WHERE productCode = :productCode ");
        $query->bindParam(':productCode',$productCode_upd);
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