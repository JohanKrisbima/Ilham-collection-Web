<?php
session_start();

include 'function.php';
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";

// echo "<pre>";
// print_r($_SESSION['size']);
// echo "</pre>";
if( !isset($_SESSION['keranjang']) or empty($_SESSION['keranjang'])){
   echo "<script>alert('Belum ada pakaian yang kamu masukkan keranjang')</script>";
   echo "<script>location= 'home.php';</script>";
    // header("Location: home.php");
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilham Collection</title>
    <link rel="stylesheet" href="./CSS/cart.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
</head>

<body>
<!-- LAYOUT 1 -->
  
<div class="layoutAwal">
    <!-- Navbar -->
    <nav>
      <ul>
        <li><a href="home.php" class="link navhome">Home</a></li>
        <li><a href="catalog.php" class="link">Catalog</a></li>
        <li><a href="how.php" class="link">How It's Work</a></li>
        <li class="trolley">
          <i class="fa-solid fa-cart-shopping"></i>
        </li>
        <li class="dropdown">
        <?php
                $select = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'") or die ('query failed');
                if(mysqli_num_rows($select)>0){
                $fetch = mysqli_fetch_assoc($select);
                }
                ?>
                <?php if($fetch['gambar'] == ''):?>
                <a href="javascript:void(0)" class="dropbtn"><img src="./Foto/user.png"></img></a>
                <?php else:?>
                <a href="javascript:void(0)" class="dropbtn"><img src="./foto_uploud/<?= $fetch['gambar']?>"></img></a>
                <?php endif;?>
          <div class="dropdown-content">
            <a href="profil.php"><i class="fas fa-user"></i> Profile</a>
            <a href="riwayat.php"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
            <!-- <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a> -->
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
      </ul>
    </nav>
  </div>

  
  
    <!-- LAYOUT KE DUA -->
    <?php $total_belanja=0;?>    
        <?php foreach($_SESSION['keranjang'] as $id_pakaian => $jumlah) :?>
            <?php
             $ambil = $conn->query("SELECT * FROM pakaian WHERE id_pakaian = '$id_pakaian'");
             $pecah = $ambil->fetch_assoc();
             $subharga = $pecah['harga']*$jumlah;
            ?>
    <div class="wadah">
        <div class="container">
       
            <div class="grid">
                <div class="pembatas1">
                    
                </div>
                <div class="pembatas2">
                    <div class="product-image">
                        <img src="./Foto/<?= $pecah['gambar']?>" class="product-thumb" alt="">
                    </div>
                </div>
                <div class="pembatas3">
                    <div class="nama-product">
                        <h1><?= $pecah['nama']?></h1>
                    </div>
                </div>

                <div class="pembatas8">
                    <span class="harga-2">Ukuran</span>
                    <p><?= $pecah['ukuran']?></p>
                </div>

                <div class="pembatas4">
                    <span class="harga-1">Harga Satuan</span>
                    <p>Rp. <?= number_format($pecah['harga'])?></p>
                </div>
                <div class="pembatas5">
                    <span class="kuantitas">Kuantitas</span>
                    <div class="card-action">
                        <!-- <button class="btn" onclick="handleCounterMin()">-</button> -->
                      <p><?= $jumlah?></p>
                        <!-- <button class="btn" onclick="handleCounterPlus()">+</button> -->

                    </div>
                </div>
                <div class="pembatas6">
                    <span class="harga-2">Total Harga</span>
                    <p>Rp. <?= number_format($subharga)?></p>
                </div>
                
                <div class="pembatas7">
                    <a href="hapuskeranjang.php?id=<?= $id_pakaian?>"><button class="hapus"><i class="fa-solid fa-trash-can"></i> Remove</button></a>
                </div>
            </div>
          
        </div>
    </div>
  
    <?php $diskon= $total_belanja+=$subharga*0.8?>
   

            <?php endforeach;?> 



    
    <!-- Footer -->
    <footer>
        
    <div class="wadah2">
        <div class="grid">
                <div class="pembatas11">
                <div class="cekbox">
                      
                    </div>
                </div>
                <div class="pembatas14">
                    <p>Total Harga: </p>
                </div>
                <div class="pembatas15">
                    <p>Rp. <?=number_format($diskon)?></p>
                </div>
                <div class="pembatas16">
                    <a href="checkout.php"><button class="co">Check Out</button></a>
                </div>
            </div>
        </div>

    </footer>
    

</body>

</html>