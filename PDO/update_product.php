<?php

include ('koneksi.php'); 

$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['productCode'])) {
        $productCode_upd = $_GET['productCode'];
        $query = $koneksi->prepare("SELECT * FROM products WHERE productCode = :productCode");
        $query->bindParam(':productCode',$productCode_upd);
        $query->execute(); 
    }  
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $query = $koneksi->prepare("UPDATE products SET productName=:productName, quantityInStock=:quantityInStock, buyPrice=:buyPrice WHERE productCode=:productCode"); 

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

    <h2 style="margin: 30px 0 30px 0;">Update Data Product</h2>
    <form action="update_product.php" method="POST">
        <?php while($pdt = $query->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="form-group">
                <label>ID Product</label>
                <input type="text" class="form-control" placeholder="Product Code" name="productCode" value="<?php echo $pdt['productCode'];  ?>" readonly required="required">
            </div>
            <div class="form-group">
                <label>Nama Product</label>
                <input type="text" class="form-control" placeholder="Product Name" name="productName" value="<?php echo $pdt['productName'];  ?>" required="required">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="text" class="form-control" placeholder="Quantity In Stock" name="quantityInStock" value="<?php echo $pdt['quantityInStock'];  ?>" required="required">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" placeholder="Buy Price" name="buyPrice" value="<?php echo $pdt['buyPrice'];  ?>" required="required">
            </div>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
</body>
</html>