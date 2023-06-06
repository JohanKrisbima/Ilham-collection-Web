<?php

include './function.php';
session_start();

$id_pembelian = $_GET['id'];

$id_admin = $_SESSION['admin'];

if( !isset($id_admin)){
    header('Location: signin.php');
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'") or die ('query failed');
if(mysqli_num_rows($select)>0){
  $fetch = mysqli_fetch_assoc($select);
}

$pembelian = query("SELECT * FROM pembelian WHERE id_pembelian = $id_pembelian")[0];

if(isset($_POST['submit'])){
    if(ubahStatus($_POST)>0){
      echo "<script>alert(' Data berhasil diUpdate')</script>";
      echo "<script>location= 'chart.php'</script>";
  
    }
    else{
      echo "<script>alert(' Data Gagal diUpdate')</script>";  
      echo "<script>location= 'chart.php'</script>";
    }
  }

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
              <a  href="index.php"
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
              <h2>Edit Data Pesanan</h2>
              <h5>Selalu Pastikan Data Produk adalah yang paling Trendi!</h5>
            </div>
          </div>
          <hr />
         
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="p1">
                <div class="kanan">
                  <table class="t1">
                    <tr>
                      <td>ID Pesanan</td>
                    </tr>
                    <tr>
                      <td><input type="text" name="id_pembelian" readonly value="<?= $pembelian['id_pembelian']?>"/></td>
                    </tr>
                    <tr>
                      <td>Total</td>
                    </tr>
                    <tr>
                      <td><input type="text" name="total" value="<?= $pembelian['total_pembelian']?>" readonly/></td>
                    </tr>
                    <tr>
                      <td>Alamat Pengiriman</td>
                    </tr>
                    <tr>
                      <td><textarea readonly><?= $pembelian['alamat_pengiriman']?></textarea></td>
                    </tr>
                    
                  </table>
                </div>
                <div class="kiri">
                  <table class="t1">
                    <tr>
                      <td>Nama Pembeli</td>
                    </tr>
                    <tr>
                      <td><input type="text" name="nama" value="<?= $pembelian['nama_pembeli']?>" readonly/></td>
                    </tr>
                    <tr>
                      <td>No. Telepon</td>
                    </tr>
                    <tr>
                      <td><input type="text" name="telepon" value="<?= $pembelian['telepon_pembeli']?>" readonly /></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                    </tr>
                    <tr>
                      <td>
                        <select name="status">
                          <option value="Dikemas">Dikemas</option>
                          <option value="Dikirim">Dikirim</option>
                          <option value="Sampai Ditujuan">Sampai Ditujuan</option>
                          <option value="Selesai">Selesai</option>
                          <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                      </td>
                     
                    </tr>
                   
                  </table>
                  <div class="btn">
                    <button class="del1" name="submit">Simpan</button>
                  </div>
                  
                </div>
              </div>
            </form>
        
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
