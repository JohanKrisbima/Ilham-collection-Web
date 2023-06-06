<?php
session_start();

include 'function.php';
$id_user =$_SESSION['login'];

$select = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'") or die ('query failed');
if(mysqli_num_rows($select)>0){
$fetch = mysqli_fetch_assoc($select);
}

if( !isset($_SESSION['keranjang']) or empty($_SESSION['keranjang'])){
   echo "<script>alert('Belum ada pakaian yang kamu masukkan keranjang')</script>";
   echo "<script>location= 'home.php';</script>";
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
        </tr>
    </thead>
    <tbody>
        <?php $No= 1; ?> 
        <?php $total_belanja= 0;?>   
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
        </tr>
        <?php $No++; ?>
        <?php $total_belanja+=$subharga;?>
        <?php endforeach;?> 
    </tbody>
    <tfoot>
        <tr>
            <th>Total Belanja</th>
            <th>Rp. <?=number_format($total_belanja)?></th>
        </tr>
    </tfoot>
   </table>

   <form action="" method="POST">
    <br>
            <input type="text" name="nama_pembeli" value="<?= $fetch['nama_lengkap']?>">
            <input type="text" name="telepon" value="<?= $fetch['telepon']?>">
            <select name="id_ongkir" >
                <?php
                    $ongkir = query("SELECT * FROM ongkir")  ;            
                ?>
                <option value="">Pilih ongkos kirim</option>
                <?php foreach($ongkir as $kirim):?>
                <option value="<?= $kirim['id_ongkir']?>">
                    <?= $kirim['nama_kota']?> - Rp.<?= number_format($kirim['tarif'])?> 
                </option>                
                <?php endforeach;?>
            </select>
            <label for="alamat">Alamat Lengkap Pengiriman</label>
            <textarea name="alamat_pengiriman" id="alamat" cols="30" rows="10" ><?= $fetch['alamat']?></textarea>
          <button name="checkout">Checkout</button>
   </form>

   <?php
    if(isset($_POST['checkout'])){
        $id_users = $fetch['id_user'];
        $id_ongkir = $_POST['id_ongkir']; 
        $tanggal_pembelian = date("Y-m-d");
        $alamat_pengiriman =  $_POST['alamat_pengiriman'];
        $nama_pembeli = $_POST['nama_pembeli'];
        $telepon = $_POST['telepon'];

        $ambil = $conn->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
        $arrayongkir = $ambil->fetch_assoc();
        $tarif = $arrayongkir['tarif'];
        $nama_kota = $arrayongkir['nama_kota'];
        $total_pembelian = $total_belanja+$tarif;
        
        // menyimpan data ke tabel pembelian
        $conn->query("INSERT INTO pembelian (id_user, id_ongkir, tanggal_pembelian,total_pembelian, nama_kota, tarif, alamat_pengiriman, nama_pembeli, telepon_pembeli) VALUES ('$id_users', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman', '$nama_pembeli', '$telepon')");

        // mendapatkan id_pembelian barusan terjadi
        $id_pembelian_barusan = $conn->insert_id;

        foreach($_SESSION['keranjang'] as $id_pakaian=>$jumlah){
            // mendapatkan data produk berdasarkan id_pakaian
            $ambil= $conn->query("SELECT * FROM pakaian WHERE id_pakaian='$id_pakaian'");
            $perproduk= $ambil->fetch_assoc();

            $nama = $perproduk['nama'];
            $ukuran = $perproduk['ukuran'];
            $harga = $perproduk['harga'];
            $subharga =$perproduk['harga']*$jumlah;
            $conn->query("INSERT INTO pembelian_pakaian (id_pembelian, id_pakaian, nama, ukuran, harga, subharga, jumlah)
             VALUES ('$id_pembelian_barusan', '$id_pakaian', '$nama', '$ukuran', '$harga','$subharga', '$jumlah')");
        }

        // mengosongkan keranjang belanja
        unset($_SESSION['keranjang']);

        // tampilan di alihkan ke halaman nota, nota dari pembelian yang barusan
        echo "<script>alert('Pembelian sukses')</script>";
        echo "<script>location= 'nota.php?id=$id_pembelian_barusan';</script>";
    }
   ?>
</body>
</html>