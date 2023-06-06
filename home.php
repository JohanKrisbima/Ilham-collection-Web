<?php 

  include 'function.php';
  session_start();
  $id_user = $_SESSION['login'];

  if( !isset($id_user)){
      header('Location: signin.php');
      exit;
  }


  $produk = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY id_pakaian DESC LIMIT 0, 10");
 // $produk = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY id_pakaian DESC");
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
  <title>Ilham Collection</title>
  <link rel="stylesheet" href="./CSS/home.css"  type="text/css"/>
  <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="./Foto/logo3.png" type="image/x-icon" />
</head>

<body>
  <!-- Layout1 -->
  <div class="layoutAwal">
    <!-- Navbar -->
    <!-- <nav>
      <ul>
        <li><a href="home.php" class="link">Home</a></li>
        <li><a href="catalog.php" class="link">Catalog</a></li>
        <li><a href="" class="link">Development</a></li>
        <li><a href="" class="link">My Acount</a></li>
        <li><a href="logout.php" class="link">Log Out</a></li>
        <li class="trolley">
          <i class="fa-solid fa-cart-shopping"></i>
        </li>
      </ul>
    </nav>  -->
    <nav>
      <ul>
        <li><a href="home.php" class="link navhome">Home</a></li>
        <li><a href="catalog.php" class="link">Catalog</a></li>
        <li><a href="how.php" class="link">How It's Work</a></li>
        <li><a href="test1.php" class="link">Test 1</a></li>
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
    <!-- <nav>
      <ul>
        <li><a href="home.php" class="link navhome">Home</a></li>
        <li><a href="catalog.php" class="link">Catalog</a></li>
       
        <li><a href="" class="link">Developer</a></li>
        <li class="trolley">
          <i class="fa-solid fa-cart-shopping"></i>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn"><img src="./Foto/user.jpg"
              class="fa-solid fa-circle-user"></img></a>
          <div class="dropdown-content">
            <a href="#"><i class="fas fa-user"></i> Profile</a>
            <a href="#"><i class="fa-solid fa-clipboard-list"></i> Pesanan</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
         </div>
      </ul>

      <! <ul class="user1">
        <li class="user"><i class="fa-solid fa-circle-user"></i></li>

      </ul> -->
   
    <!-- Awal -->
    <div class="awal">
      <h1>ILHAM COLLECTION</h1>
      <p class="judul" style="color: white">
        Solusi Belanja Hemat dan Trendi!
      </p>
      <a href="vid.php">
        <button class="btn1">Click on Me!</button>
    </a>
    </div>
  </div>

  <!-- Layout 2 -->
  <div class="layoutKedua">
    <h2>ILHAM COLLECTION</h2>
    <!-- <div class="pembatas"> -->
    <!-- </div> -->
      <p class="dis" style="color: black">
      <!-- Junia Cantik -->
        Merupakan salah satu Toko Fashion asal Indonesia yang mengedepankan kualitas dan desain produknya
        yang cocok nyaman dan trendi untuk kegiatan sehari-hari maupun traveling.
      </p>
  </div>

  <!-- Section -->
  <div class="content">
    <section class="product"> 
      <!-- Teks Animasi -->
      <div class="rotating-text">
        <p>Koleksi Produk</p>
        <p>
          <span class="word w1">Terlaris</span>
          <span class="word w2">Terpopuler</span>
          <span class="word w3">Trendi</span>
        </p>
      </div>
      <!-- Button Slidder -->
      <button class="pre-btn"><img src="/Icon/arrow.png" alt=""></button>
      <button class="nxt-btn"><img src="/Icon/arrow.png" alt=""></button>
      
      <div class="product-container">
        <!-- Card -->      
        <?php foreach($produk as $p):?>
          <div class="product-card">
            <!-- Foto produk -->
              <div class="product-image">
                  <img src="./Foto/<?= $p['gambar']?>" class="product-thumb" alt="">
                  <a href="detailProduct.php?id=<?= $p['id_pakaian']?>"><button class="card-btn">Beli Sekarang</button></a>
              </div>
              <!-- Deskripsi ges -->
              <div class="product-info">
                  <h2 class="product-brand"><?= $p['jenis']?></h2>
                  <p class="product-short-description"><?=$p['nama']?></p>
                  <span class="price">Rp. <?= number_format($p['harga']) ?></span>
              </div>
          </div>
          <?php endforeach; ?>
          <!-- End Card -->
          
      </div>
  </section>
  </div>

  <!-- Layout 3 -->
  <div class="layoutKetiga">
    <div class="kiri">
      <img src="./Foto/bg12.png" alt="">
    </div>
    <div class="kanan">
      <h3>Tampil Memukau dan Raih Mimpimu</h3>
      <p>Perbaiki fashion ga perlu mahal? Ilham Collection solusinya</p>
      <p>Lebih percaya diri disetiap moment!</p>
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

</body>
<script src="./JS/home.js"></script>

</html>