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
    <title>Admin IC Store</title>
    <link rel="shortcut icon" href="Foto/logo3.png" type="image/x-icon" />
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
                        <a href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a  class="active-menu" href="member.php"><i class="fa-solid fa-users fa-3x"></i> Member</a>
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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Member</h2>   
                        <h5>Data Pelanggan Setia Ilham Collection. </h5>
                    </div>
                </div>
                 <hr />
                 <div>
                    <table  class="table table-bordered">
                        <thead class="th1">
                            <td>Foto</td>
                            <td>Username</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>No. Telepon</td>
                            <td>Alamat</td>
                            <td>Action</td>
                        </thead>
                       
                        <?php foreach($user as $clien):?>
                        <tr>
                            <td><img src="../foto_uploud/<?= $clien['gambar']?>" alt="belum upload foto"  class="photo"></td>
                            <td><?= $clien['username']?></td>
                            <td><?= $clien['nama_lengkap']?></td>
                            <td><?= $clien['email']?></td>
                            <td><?= $clien['telepon']?></td>
                            <td><?= $clien['alamat']?></td>
                            <td><button class="delete"><a href="hapusUser.php?id=<?= $clien['id_user']?>"><i class="fa-solid fa-trash"></i></a></button></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
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
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
