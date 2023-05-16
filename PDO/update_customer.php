<?php

include ('koneksi.php'); 

$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['customerNumber'])) {
        $customerNumber_upd = $_GET['customerNumber'];
        $query = $koneksi->prepare("SELECT * FROM customers WHERE customerNumber = :customerNumber");
        $query->bindParam(':customerNumber',$customerNumber_upd);
        $query->execute(); 
    }  
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber = $_POST['customerNumber'];
    $customerName = $_POST['customerName'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $query = $koneksi->prepare("UPDATE customers SET customerName=:customerName, phone=:phone, city=:city WHERE customerNumber=:customerNumber"); 

    $query->bindParam(':customerNumber',$customerNumber);
    $query->bindParam(':customerName',$customerName);
    $query->bindParam(':phone',$phone);
    $query->bindParam(':city',$city);

    if ($query->execute()) {
        $status = 'ok';
    }
    else{
        $status = 'err';
    }

    header('Location: index.php?status='.$status);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDO</title>
</head>

<body>
    <h3>Pemrograman Web</h3>

    <ul class="nav flex-column" style="margin-top:100px;">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo "index.php"; ?>">Data Customer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo "form_customer.php"; ?>">Tambah Data Customer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo "form_product.php"; ?>">Tambah Data Product</a>
        </li>
    </ul>

    <h2 style="margin: 30px 0 30px 0;">Update Data Customer</h2>
    <form action="update_customer.php" method="POST">
        <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="form-group">
                <label>Customer Number</label>
                <input type="text" class="form-control" placeholder="ID Customer" name="customerNumber" value="<?php echo $data['customerNumber'];  ?>" readonly required="required">
            </div>
            <div class="form-group">
                <label>Nama Customer</label>
                <input type="text" class="form-control" placeholder="Customer Name" name="customerName" value="<?php echo $data['customerName'];  ?>" required="required">
            </div>
            <div class="form-group">
                <label>No Telp</label>
                <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php echo $data['phone'];  ?>" required="required">
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $data['city'];  ?>" required="required">
            </div>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>