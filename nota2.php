<?php
session_start();
include 'function.php';
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota pembelian</title>
</head>
<body>
  <h2>Detail Pembelian</h2>

  <?php
  $ambil = $conn->query("SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user WHERE pembelian.id_pembelian='$_GET[id]'");
  $detail = $ambil->fetch_assoc();
  ?>

  <!-- melindungi nota dari akses url  -->
  <?php
  // mendapatkan id_user yang beli
  $id_user_yangBeli = $detail['id_user'];

  // mendapatkan id_user yang login
  $id_user_yanLogin = $id_user;

  if($id_user_yangBeli !== $id_user_yanLogin){
    echo "<script>alert('JANGAN MENCOBA MENGAKSES NOTA YANG BUKAN MILIK ANDA')</script>";
    echo "<script>location= 'riwayat.php'</script>";
  }
  ?>
  
  
  <div class="container" style="display: flex; ">
    <div class="pembelian" style="margin-right:20px">
    <p>
      <strong> Pembelian</strong> <br>
      <strong>No.Pembelian: <?php echo $detail['id_pembelian'];?></strong><br>
      Tanggal: <?= $detail['tanggal_pembelian'];?> <br>
      Total: <?= $detail['total_pembelian']?>
      </p>
    </div>
    <div class="pelanggan" style="margin-right:20px">
      <p>
      <strong> Pelanggan</strong> <br>
      <strong><?php echo $detail['nama_pembeli'];?></strong><br>
      No.telepon: <?= $detail['telepon_pembeli'];?> <br>
      Email: <?= $detail['email']?> <br>
      </p>
    </div>
    <div class="pengiriman">  
      <p>
      <strong>Pengiriman</strong> <br>
      <strong><?php echo $detail['nama_kota'];?></strong><br>
          Ongkir Rp.<?= number_format($detail['tarif']) ?>
          <br>
          Alamat: <?= $detail['alamat_pengiriman']?>
      </p>
    </div>
  </div>
  
  

  <table border="1" cellpadding="1" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pakaian</th>
            <th>Ukuran</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1;?>
        <?php $ambil=$conn->query("SELECT * FROM pembelian_pakaian WHERE id_pembelian='$_GET[id]'");?>
        <?php while($pecah=$ambil->fetch_assoc()):?>
            <tr>
                <td><?= $nomor?></td>
                <td><?= $pecah['nama']?></td>
                <td><?= $pecah['ukuran']?></td>
                <td><?=  number_format($pecah['harga'])?></td>
              
                <td><?= $pecah['jumlah']?></td>
                <td>
                    <?= number_format($pecah['subharga']) ?>
                </td>
            </tr>
            <?php $nomor++;?>
        <?php endwhile;?>    
    </tbody>
  </table>

  <div class="row" style="background-color: aqua;">
    <p>
        Silahkan melakukan pembayaran Rp.<?= number_format($detail['total_pembelian'])?> ke <br>
        <strong>BANK BCA 1231-23141 AN.ILHAM GUSTI</strong>
    </p>
  </div>
</body>
</html>