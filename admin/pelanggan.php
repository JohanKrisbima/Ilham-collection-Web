<?php
include './function.php';
session_start();
$id_admin = $_SESSION['admin'];

if( !isset($id_admin)){
    header('Location: signin.php');
    exit;
}

$user = query("SELECT * FROM user ORDER BY id_user");

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
              <a class="active-menu" href="pelanggan.php"><i class="fa fa-desktop fa-3x"></i> Pelanggan</a>
            </li>
            <li>
              <a href="pembelian.php"><i class="fa fa-qrcode fa-3x"></i> Pembelian</a>
            </li>
            <li>
              <a href="produk.php"><i class="fa fa-bar-chart-o fa-3x"></i> produk</a>
            </li>
           
          </ul>
        </div>
      </nav>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
        <h1>Daftar Pelanggan</h1>

        <table  class="table table-bordered">
          <thead>
          <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Email</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
          <?php $no=1;?>
        <?php foreach($user as $clien):?>
        <tr>
            <td><?= $no?></td>
            <td><img src="../foto_uploud/<?= $clien['gambar']?>" alt="belum upload gambar" width="50px" height="50px"></td>
            <td><?= $clien['email']?></td>
            <td><?= $clien['username']?></td>
            <td><?= $clien['nama_lengkap']?></td>
            <td><?= $clien['telepon']?></td>
            <td><?= $clien['alamat']?></td>
            <td><a href="hapusUser.php?id=<?= $clien['id_user']?>">Hapus</a></td>
        </tr>
        <?php $no++?>
        <?php endforeach;?>
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
