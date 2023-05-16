<?php 
include ('koneksi.php'); 
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
    
    <?php 
        if (@$_GET['status']!==NULL) {
            $status = $_GET['status'];
            if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil di-update</div>';
            }
            elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal di-update</div>';
            }
        }
    ?>

    <h2 style="margin: 30px 0 30px 0;">Customer</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Customer Number</th>
                    <th>Nama Customer</th>
                    <th>No Telp</th>
                    <th>Kota</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM customers";
                    $result = $koneksi -> query($query);
                ?>

                <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                    <tr>
                        <td><?php echo $data['customerNumber'];  ?></td>
                        <td><?php echo $data['customerName'];  ?></td>
                        <td><?php echo $data['phone'];  ?></td>
                        <td><?php echo $data['city'];  ?></td>
                        <td>
                            <a href="<?php echo "update_customer.php?customerNumber=".$data['customerNumber']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                            &nbsp;&nbsp;
                            <a href="<?php echo "delete_customer.php?customerNumber=".$data['customerNumber']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>

    <?php 
        if (@$_GET['status']!==NULL) {
            $status = $_GET['status'];
            if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Product berhasil di-update</div>';
            }
            elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Product gagal di-update</div>';
            }
        }
    ?>

    <h2 style="margin: 30px 0 30px 0;">Product</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID Product</th>
                    <th>Nama Product</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM products";
                    $hasil = $koneksi->query($query);
                ?>

                <?php while($pdt = $hasil->fetch(PDO::FETCH_ASSOC) ): ?>
                    <tr>
                        <td><?php echo $pdt['productCode'];  ?></td>
                        <td><?php echo $pdt['productName'];  ?></td>
                        <td><?php echo $pdt['quantityInStock'];  ?></td>
                        <td><?php echo $pdt['buyPrice'];  ?></td>
                        <td>
                            <a href="<?php echo "update_product.php?productCode=".$pdt['productCode']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                            &nbsp;&nbsp;
                            <a href="<?php echo "delete_product.php?productCode=".$pdt['productCode']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>