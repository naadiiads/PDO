<?php

include ('koneksi.php'); 

$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    
    $query = $koneksi->prepare("INSERT INTO products (productCode, productName, quantityInStock, buyPrice) VALUES(:productCode, :productName, :quantityInStock, :buyPrice)"); 

    $query->bindParam(':productCode',$productCode);
    $query->bindParam(':productName',$productName);
    $query->bindParam(':quantityInStock',$quantityInStock);
    $query->bindParam(':buyPrice',$buyPrice);

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

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <?php 
            if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Product berhasil disimpan</div>';
            }
            elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Product gagal disimpan</div>';
            }
        ?>

        <h2 style="margin: 30px 0 30px 0;">Form Product</h2>
        <form action="form_product.php" method="POST">
            <div class="form-group">
                <label>ID Product</label>
                <input type="text" class="form-control" placeholder="Product Code" name="productCode" required="required">
            </div>
            <div class="form-group">
                <label>Nama Product</label>
                <input type="text" class="form-control" placeholder="Product Name" name="productName" required="required">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="text" class="form-control" placeholder="Quantity In Stock" name="quantityInStock" required="required">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" placeholder="Buy Price" name="buyPrice" required="required">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </main>
    
</body>
</html>