<?php
session_start();
include 'function.php';
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="./css/nota.css">
    <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
    <title>Ilham Collection</title>
</head>

<body>

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
  

    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <div class="p1">
                    <img src="./foto/logo3.png" alt="" class="img-fluid">
                    </div>
                    <div class="p2">
                    <h1>Ilham Collection</h1>
                    <p>Desa Kmuning RT. 12 RW. 01, Kec. Tarik, Kab. Sidoarjo | 612611</p>
                    </div>
                </div>
                <!-- <div class="top-left">
                    <div class="graphic-path">
                        <p>Invoice</p>
                    </div>
                    <div class="position-relative">
                        <p>Invoice No. <span>XXXX</span></p>
                    </div>
                </div> -->
            </section>
            <div class="ekstra">
                        <div class="cus">
                            <p class="cus1">Customer,</p>
                            <h2><?php echo $detail['nama_pembeli'];?></h2>
                            <p>No. Telp : <?= $detail['telepon_pembeli'];?></p>
                            <!-- <p> Alamat Pengiriman :  -->
                            <p><?= $detail['alamat_pengiriman']?></p>
                        </div>
                        <div class="garis">

                        </div>
                        <div class="detail">
                        <p>No. Pesanan: <?php echo $detail['id_pembelian'];?></p>
                        <p>Metode Pembayaran: Transfer Bank</p>
                        <p>Tanggal Pemesanan:  <?= $detail['tanggal_pembelian'];?></p>
                        </div>
                    </div>

            <section class="product-area mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Produk</td>
                            <td>Ukuran</td>
                            <td>Harga</td>
                            <td>Kuantitas</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $ambil=$conn->query("SELECT * FROM pembelian_pakaian WHERE id_pembelian='$_GET[id]'");?>
                    <?php $total_belanja=0;?>
                    <?php while($pecah=$ambil->fetch_assoc()):?>
                        <tr>
                           
                            <td>
                                <div class="media">
                                    <img class="mr-3 img-fluid" src="./Foto/<?= $pecah['gambar']?>">
                                    <div class="media-body">
                                        <p class="mt-0 title"><?= $pecah['nama']?></p>
                                    </div>
                                </div>
                            </td>
                            <td><?= $pecah['ukuran']?></td>
                            <td>Rp.<?=  number_format($pecah['harga'])?></td>
                            <td><?= $pecah['jumlah']?></td>
                            <td>Rp.<?= number_format($pecah['subharga']) ?></td>
                        </tr>
                        <?php $total_belanja+=$pecah['subharga']?>
                    <?php endwhile;?> 
                    </tbody>
                </table>
            </section>

            <section class="balance-info">
                <div class="row">
                    <div class="col-8" id="note">
                        <p class="m-0 font-weight-bold"> Note: </p>
                        <p>1. Lakukan pembayaran sejumlah yang tertera diatas ke nomer rekening 633021929 a/n ilham gusti syah putro.</p>
                        <p>2. Upload bukti transfer berupa screenshot atau foto slip pembayaran pada fitur riwayat pesanan.</p>
                        <p>3. Lakukan pengecekan status pesanan Anda.</p>
                       
                    </div>
                    <div class="col-4">
                        <table class="table border-0 table-hover">
                            <tr>
                                <td>Sub Total:</td>
                                <td>Rp.<?= number_format($total_belanja)?></td>
                            </tr>
                            <tr>
                                <td>Ongkir:</td>
                                <td>Rp.<?= number_format($detail['tarif']) ?></td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <h2>
                                        <td>Grand Total:</td>
                                    <td>Rp.<?= number_format($detail['total_pembelian']) ?></td>
                                    </h2>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </section>

            <!-- Cart BG -->
            <div class="wadah">
                <div class="cart">
                   
                </div>
                <div class="ttd">
                        
                        </div>
                </div>
            </div>
            <img src="cart.jpg" class="img-fluid cart-bg" alt="">

            <footer>
                <hr>
                <p class="m-0 text-center">
                    Terima kasih atas pesanan Anda!
                </p>
               
                <div class="social pt-3">
                    <span class="pr-2">
                        <i class="fas fa-mobile-alt"></i>
                        <span>08970967893</span>
                    </span>
                    <span class="pr-2">
                    <a href="#"><i class="fa fa-youtube"></i></a>
                        <span>ilhamCollection</span>
                    </span>
                    <span class="pr-2">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                        <span>ilhamCollection</span>
                    </span>
                    <span class="pr-2">
                    <a href="#"><i class="fa fa-instagram"></i></a>
                        <span>ilhamCollection</span>
                    </span>
                    <span class="pr-2">
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        <span>ICStore</span>
                    </span>
                </div>
            </footer>
        </div>
    </div>










</body></html>