<?php

include './function.php';
session_start();
$id_admin = $_SESSION['admin'];

if( !isset($id_admin)){
    header('Location: signin.php');
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'") or die ('query failed');
if(mysqli_num_rows($select)>0){
  $fetch = mysqli_fetch_assoc($select);
}

$pendapatan = query("SELECT * FROM pembayaran");
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
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
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>


                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="member.php"><i class="fa-solid fa-users fa-3x"></i> Member</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-shirt fa-3x"></i> Produk<span
                                class="fa arrow"></span></a>
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
                        <a href="chart.php"><i class="fa-solid fa-cart-shopping fa-3x"></i> Pesanan</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Admin Dashboard</h2>
                        <h5>Halo Admin IC Store, Cek Toko Mu Sekarang!</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <?php $pakaian = count(query("SELECT * FROM pakaian"))?>
                <?php $pesanan = count(query("SELECT * FROM pembelian"))?>
                <?php $member = count(query("SELECT * FROM user"))?>
                <?php $dikemas = count(query("SELECT * FROM pembelian WHERE status_pembelian = 'Dikemas'"))?>
                <?php $dikirim = count(query("SELECT * FROM pembelian WHERE status_pembelian = 'Dikirim'"))?>
                <?php $selesai = count(query("SELECT * FROM pembelian WHERE status_pembelian = 'Selesai'"))?>
                <?php $dibatalkan = count(query("SELECT * FROM pembelian WHERE status_pembelian = 'Dibatalkan'"))?>

                <?php $hasil=0;?>
                <?php foreach($pendapatan as $jumlah):?>
                <?php $hasil+=$jumlah['jumlah']?>  
                <?php endforeach;?>
                
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $member?> </p>
                                <p class="text-muted">Member</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-shirt"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $pakaian?></p>
                                <p class="text-muted">Produk</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-cart-shopping "></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $pesanan?> </p>
                                <p class="text-muted">Pesanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-rectangle-xmark"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $dibatalkan?></p>
                                <p class="text-muted">Dibatalkan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-box"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $dikemas?></p>
                                <p class="text-muted">Dikemas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-truck"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $dikirim?></p>
                                <p class="text-muted">Dikirim</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-square-check"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $selesai?></p>
                                <p class="text-muted">Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box set-icon">
                                <i class="fa-solid fa-credit-card"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= number_format($hasil)?></p>
                                <p class="text-muted">Pendapatan</p>
                            </div>
                        </div>
                    </div>
                </div>
               
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