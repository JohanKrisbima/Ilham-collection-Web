<?php
include 'function.php';
session_start();
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}


// pagination
// konfigurasi
$jumlahDataPerhalaman = 15;
$jumlahData = count(query("SELECT * FROM pakaian"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

 $produk = query("SELECT * FROM pakaian ORDER BY id_pakaian ASC LIMIT $awalData, $jumlahDataPerhalaman");
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
  <title>Ilham Collection</title>
  <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
  <link rel="stylesheet" href="./css/catalog.css" type="text/css"/>
  <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
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
        <!-- <li class="user"><img src="/foto/user.jpg" class="fa-solid fa-circle-user"></img></li> -->
        <li class="trolley">
          <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>

      </ul>
    </nav>
    <!-- Awal -->
    <div class="awal">
      <!-- <p class="judul" style="color: rgb(255, 253, 253)">
        Solusi Belanja Hemat dan Trendi!
      </p> -->
      <div class="fitur">
        
          <ul>
            <li class="search-box">
              <input type="text" placeholder="Tentukan stylemu sekarang" name="keyword" autocomplete="off" autofocus id="keyword">
              <div class="search-icon">
                <i class="fas fa-search"></i>
              </div>
              <!-- <div class="cancel-icon">
                <i class="fas fa-times"></i>
              </div> -->
              <div class="search-data">
              </div>
            </li>
          </ul>
      </div>
    </div>
  </div>

  <!-- LAYOUT 2 -->

  <div id="container">
    <div class="product-container">

      <!-- Card -->
      <?php foreach($produk as $p):?>
      <div class="product-card">
        <div class="product-image"> 
          <!-- <span class="cart-tag"><i class="fa-solid fa-cart-shopping"></i></span> -->
          <img src="./Foto/<?= $p['gambar']?>" class="product-thumb" alt="">
          <a href="detailProduct.php?id=<?php echo $p['id_pakaian']?>" style="position: relative; bottom:20px"><button class="card-btn">Detail Produk</button></a>
        </div>
        <div class="product-info">
          <h2 class="product-brand"><?= $p['jenis']?></h2>
          <p class="product-short-description"><?= $p['nama']?></p>
          <span class="price">Rp. <?= number_format($p['harga']) ?></span>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    
    
      <div class="pagination" style="display: flex; justify-content:center;">
        <?php for($i= 1; $i<=$jumlahHalaman; $i++) :?>
            <?php if($i == $halamanAktif ) :?>
                <a href="?page=<?= $i?>" class="aktif"> <?= $i; ?></a>
            <?php else: ?>
                <a href="?page=<?= $i?>" class="off" style="font-weight: bold; color:black"> <?= $i; ?></a>
            <?php endif; ?>
        <?php endfor;?> 
      </div>

     
      </div>  
  
  

  <!-- Layout 3 -->
  <div class="layoutKetiga">
    <div class="kiri">
      <img src="./Foto/bg16.jpg" alt="">
    </div>
    <div class="kanan">
      <h3>Tentukan Stylemu Sekarang!</h3>
      <p>Siap jadi pusat perhatian?</p>
      <p>Ilham Collection pilihan yang tepat</p>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <!-- kiri -->
    <div class="footer-left">
      <h3>Pembayaran</h3>
      <div class="ewallet">
        <img src="./Icon/logoBankjatim.png" alt="">
       
      </div>
      <br>
      <h3>Pengiriman</h3>
      <div class="ewallet">
        <img src="./Icon/jnt.png" alt="">
      </div>
    </div>
    <!-- Tengah -->
    <div class="footer-center">
      <h3>Informasi Toko</h3>
      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Indonesia</span>
          Ds. Kemuning Kec. Tarik</p>
      </div>
      <div>
        <i class="fa fa-phone"></i>
        <p>+62 897 046 561</p>
      </div>
      <div>
        <i class="fa fa-envelope"></i>
        <p><a href="#">E41212045@studentpolije.ac.id</a></p>
      </div>
    </div>
    <!-- Kanan -->
    <div class="footer-right">
      <p class="about">
        <span>Ilham Collection</span>
        <p>Memberi kesempatan bagi seluruh wanita dan pria Indonesia untuk menghadirkan energi dan gaya casual-elegan
          ke dalam tampilan mereka sehari-hari sehingga semakin percaya diri.</p>
      </p>
      <div class="media">
        <span>Sosial Media</span>
        <a href="https://www.youtube.com/channel/UCWATk8N1fZGhNxiE5YGJkwQ"><i class="fa fa-youtube"></i></a>
        <a href="https://www.facebook.com/ilham.gusti.355"><i class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/_ilhamgs/"><i class="fa fa-instagram"></i></a>
        <a href="http://tiktok.com/@ilhamgs"><i class="fa-brands fa-tiktok"></i></a>
      </div>
    </div>
  </footer>

  <script src="./JS/catalog.js"></script>

</body>

</html>