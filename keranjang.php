<?php
session_start();
include 'function.php';

if( !isset($_SESSION['keranjang']) or empty($_SESSION['keranjang'])){
   echo "<script>alert('Belum ada pakaian yang kamu masukkan keranjang')</script>";
   echo "<script>location= 'home.php';</script>";
    // header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <table border="1" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Pakaian</th>
            <th>Harga</th>
            <th>Size</th>
            <th>Jumlah</th>
            <th>Subharga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $No= 1; ?>
        <?php foreach($_SESSION['keranjang'] as $id_pakaian => $jumlah) :?>
            <?php
             $ambil = $conn->query("SELECT * FROM pakaian WHERE id_pakaian = '$id_pakaian'");
             $pecah = $ambil->fetch_assoc();
             $subharga = $pecah['harga']*$jumlah;
            ?>
            
        <tr>
            <td><?=$No?></td>
            <td><?= $pecah['nama']?></td>
            <td><?= number_format( $pecah['harga'])?></td>
            <td><?= $pecah['ukuran']?></td>
            <td><?= $jumlah?></td>
            <td><?= number_format($subharga) ?></td>
            <td>
                <a href="hapuskeranjang.php?id=<?= $id_pakaian?>">Hapus</a>
            </td>
        </tr>
        <?php $No++; ?>
        <?php endforeach;?> 
    </tbody>
   </table>

   <a href="home.php">Lanjutkan Belanja</a>
   <a href="checkout.php">Checkout</a>
</body>
</html>