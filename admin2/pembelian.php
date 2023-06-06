<?php
include "./function.php";

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="wrapper">
      <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Binary admin</a>
        </div>
        <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px">Last access : 30 May 2014 &nbsp; <a href="login.html" class="btn btn-danger square-btn-adjust">Logout</a></div>
      </nav>
      <!-- /. NAV TOP  -->
      <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
          <ul class="nav" id="main-menu">
            <li class="text-center">
              <img src="assets/img/find_user.png" class="user-image img-responsive" />
            </li>

            <li>
              <a href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
            </li>
            <li>
              <a  href="pelanggan.php"><i class="fa fa-desktop fa-3x"></i> Pelanggan</a>
            </li>
            <li>
              <a class="active-menu" href="pembelian.php"><i class="fa fa-qrcode fa-3x"></i> Pembelian</a>
            </li>
            <li>
              <a  href="produk.php"><i class="fa fa-bar-chart-o fa-3x"></i> produk</a>
            </li>
           
          </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
        <h1>Data Pembelian</h1>
        <table  class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Option</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $ambil = $conn->query("SELECT * FROM pembelian JOIN user ON pembelian.id_user=user.id_user");
            ?>
            <?php $no=1;?>
            <?php while($pecah = $ambil->fetch_assoc()):?>
            <tr>
                <td><?= $no?></td>
                <td><?= $pecah['nama_lengkap']?></td>
                <td><?= $pecah['status_pembelian']?></td>
                <td><?= $pecah['tanggal_pembelian']?></td>
                <td>Rp. <?= number_format($pecah['total_pembelian'])?></td>
                <td>
                    <a href="nota.php?id=<?= $pecah['id_pembelian']?>" class="btn btn-warning">Nota</a>
                    <?php if($pecah['status_pembelian']== 'Sedang Dikemas'):?>
                    <a href="pembayaran.php?id=<?= $pecah['id_pembelian']?>" class="btn btn-info">Lihat Pembayaran</a>
                    <?php endif;?>  
                </td>
                <td>
                  <a href="editStatus.php?id=<?= $pecah['id_pembelian']?>" class="btn btn-info">Edit</a>
                </td>
            </tr>
            <?php $no++?>
            <?php endwhile;?>
        </tbody>
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
