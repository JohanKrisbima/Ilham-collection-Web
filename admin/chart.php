<?php
include "./function.php";

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin IC Store</title>
    <link rel="shortcut icon" href="Foto/logo3.png" type="image/x-icon" />
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
    <script
      src="https://kit.fontawesome.com/c6d8f06459.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body>
    <div id="wrapper">
      <nav
        class="navbar navbar-default navbar-cls-top"
        role="navigation"
        style="margin-bottom: 0"
      >
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target=".sidebar-collapse"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Admin IC Store</a>
        </div>
        <div style="color: white;
            margin-top: 20px;
margin-right: 30px;
float: right;
font-size: 16px;"> <a href="logout.php"><button class="btn1">Logout</button></a> </div>
      </nav>
      <!-- /. NAV TOP  -->
      <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
          <ul class="nav" id="main-menu">
            <li class="text-center">
              <img
                src="assets/img/find_user.png"
                class="user-image img-responsive"
              />
            </li>

            <li>
              <a href="index.php"
                ><i class="fa fa-dashboard fa-3x"></i> Dashboard</a
              >
            </li>
            <li>
              <a href="member.php"
                ><i class="fa-solid fa-users fa-3x"></i> Member</a
              >
            </li>
            <li>
              <a href="#"
                ><i class="fa-solid fa-shirt fa-3x"></i> Produk<span
                  class="fa arrow"
                ></span
              ></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="allproduk.php"> Semua Produk</a>
                </li>
                <li>
                  <a href="addproduk.php">Tambahkan Produk</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="active-menu" href="chart.php"
                ><i class="fa-solid fa-cart-shopping fa-3x"></i> Pesanan</a
              >
            </li>
          </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h2>Pesanan</h2>
              <h5>Selalu Berikan Yang Terbaik Untuk Member IC Store!</h5>
            </div>
          </div>
          <hr />
          <table  class="table table-bordered">
            <thead class="th1">
              <td>No.</td>
                <td>ID. Pesanan</td>
                <td>Nama</td>
                <td>Total</td>
                <td>No. Telepon</td>
                <td>Alamat Pengiriman</td>
                <td>Status</td>
                <td>Option</td>
                <td>Action</td>
            </thead>

            <?php 
            $ambil = $conn->query("SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user ORDER BY id_pembelian DESC ");
            ?>
            <?php $no=1;?>
            <?php while($pecah = $ambil->fetch_assoc()):?>
            <tr>
                <td><?= $no?></td>
                <td><?= $pecah['id_pembelian']?></td>
                <td><?= $pecah['nama_pembeli']?></td>
                <td><?= number_format($pecah['total_pembelian'])?></td>
                <td><?= $pecah['telepon_pembeli']?></td>
                <td><?= $pecah['alamat_pengiriman']?></td>
                <td><button class="del2"><?= $pecah['status_pembelian']?></button></td>
                <td>
                    <a href="nota.php?id=<?= $pecah['id_pembelian']?>"><button class="del1">Nota</button></a>
                    <?php if($pecah['status_pembelian'] === 'Dikemas') :?>
                    <a href="payment.php?id=<?= $pecah['id_pembelian']?>"><button class="del1">Pembayaran</button></a> 
                    <?php endif;?>
                    <?php if($pecah['status_pembelian'] === 'Dikirim'):?>
                    <a href="payment.php?id=<?= $pecah['id_pembelian']?>"><button class="del1">Pembayaran</button></a> 
                    <?php endif;?>
                    <?php if($pecah['status_pembelian'] === 'Selesai'):?>
                    <a href="payment.php?id=<?= $pecah['id_pembelian']?>"><button class="del1">Pembayaran</button></a> 
                    <?php endif;?>
                    
                    <?php if($pecah['status_pembelian'] === 'Sampai Ditujuan'):?>
                    <a href="payment.php?id=<?= $pecah['id_pembelian']?>"><button class="del1">Pembayaran</button></a> 
                    <?php endif;?>
                </td>
                <td>
                  <a href="hapusPesanan.php?id=<?= $pecah['id_pembelian']?>"><button class="delete"><i class="fa-solid fa-trash"></a></i></button>
                  <?php if($pecah['status_pembelian'] === 'Belum Dibayar'):?>
                  <a href="editPesanan.php?id=<?= $pecah['id_pembelian']?>"><button class="delete1"><i class="fa-solid fa-pen"></i></button></a>
                  <?php endif;?>
                  <?php if($pecah['status_pembelian'] === 'Dikemas'):?>
                  <a href="editPesanan.php?id=<?= $pecah['id_pembelian']?>"><button class="delete1"><i class="fa-solid fa-pen"></i></button></a>
                  <?php endif;?>
                  <?php if($pecah['status_pembelian'] === 'Dikirim'):?>
                  <a href="editPesanan.php?id=<?= $pecah['id_pembelian']?>"><button class="delete1"><i class="fa-solid fa-pen"></i></button></a>
                  <?php endif;?>
                  <?php if($pecah['status_pembelian'] === 'Sampai Ditujuan'):?>
                  <a href="editPesanan.php?id=<?= $pecah['id_pembelian']?>"><button class="delete1"><i class="fa-solid fa-pen"></i></button></a>
                  <?php endif;?>
                </td>
            </tr>
            <?php $no++?>
            <?php endwhile;?>
        </table>
        </div>
        <!-- /. PAGE INNER  -->
      </div>
      <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
