<?php
include './function.php';

$id_pembayaran = $_GET['id'];

$ambil = $conn->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembayaran'");
$pecah = $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo"</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
</head>
<body>
    <h1>Data Pembayaran</h1>
    <img src="./bukti_tf/<?= $pecah['bukti_pembayaran']?>" alt="belum upload gambar" width="50px" height="50px">
    <p><?= $pecah['bank']?></p>
    <p><?= $pecah['bukti_pembayaran']?></p>
</body>
</html>