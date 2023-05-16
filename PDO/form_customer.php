<?php

include ('koneksi.php'); 

$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerNumber = $_POST['customerNumber'];
    $customerName = $_POST['customerName'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    
    $query = $koneksi->prepare("INSERT INTO customers (customerNumber, customerName, phone, city) VALUES(:customerNumber, :customerName, :phone, :city)"); 

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

    <main role="main">
        <?php 
            if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data customer berhasil disimpan</div>';
            }
            elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data customer gagal disimpan</div>';
            }
        ?>

        <h2 style="margin: 30px 0 30px 0;">Form Customer</h2>
        <form action="form_customer.php" method="POST">
            <div class="form-group">
                <label>Customer Number</label>
                <input type="text" class="form-control" placeholder="ID Customer" name="customerNumber" required="required">
            </div>
            <div class="form-group">
                <label>Nama Customer</label>
                <input type="text" class="form-control" placeholder="Customer Name" name="customerName" required="required">
            </div>
            <div class="form-group">
                <label>No Telp</label>
                <input type="text" class="form-control" placeholder="Phone" name="phone" required="required">
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" class="form-control" placeholder="City" name="city" required="required">
            </div>  
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </main>
</body>
</html>