<?php
include 'function.php';
session_start();
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ilham Collection</title>
  <link rel="stylesheet" href="./CSS/how.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
  </div>

  <!-- LAYOUT KE DUA -->
  <div class="wadah">

    <!-- Login -->
    <div class="p1" data-aos="fade-right" data-aos-duration="1000">
      <div class="kiri1">
        <img src="./Foto/fix1.jpg" class="img-1">
      </div>
      <div class="kanan1">
        <h2>Buat Akun</h2>
        <p>Kunjungi Website Ilham Collection.</p>
        <p>Lakukan registrasi akun dengan menginputkan data yang benar.</p>
        <p>Login sesuai akun yang telah di registrasi.</p>
      </div>
    </div>
    <!-- Katalog -->
    <div class="p2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
      <div class="kanan1">
        <h2>Kunjungi Katalog</h2>
        <p>Koleksi pakaian terpopuler tersedia di Ilham Collection.</p>
        <p>Pastikan Anda selalu mengecek produk terbaru dan terkini.</p>
        <p>Jadikan produk impian menjadi kepunyaan.</p>
      </div>
      <div class="kiri1">
        <img src="./Foto/fix2.jpg" class="img-1">
      </div>
    </div>
    <!-- Detail Produk -->
    <div class="p1" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
      <div class="kiri1">
        <img src="./Foto/fix3.jpg" class="img-1">
      </div>
      <div class="kanan1">
        <h2>Pilih Produk</h2>
        <p>Menampilkan informasi lengkap terkait produk.</p>
        <p>Pastikan Anda membaca detail produk sebelum membeli.</p>
        <p>Masukkan produk impian Anda ke Keranjang.</p>
      </div>
    </div>
    <!-- Keranjang -->
    <div class="p2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <div class="kanan1">
        <h2>Masukkan Keranjang</h2>
        <p>Masukkan semua produk impian Anda kedalam keranjang.</p>
        <p>Anda bisa melihat total dari seluruh produk yang ada di keranjang.</p>
        <p>Anda juga dapat menghapus produk yang kurang sesuai.</p>
      </div>
      <div class="kiri1">
        <img src="./Foto/fix4y.jpg" class="img-1">
      </div>
    </div>
    <!-- Checkout -->
    <div class="p1" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300">
      <div class="kiri1">
        <img src="./Foto/checkout.jpeg" class="img-1">
      </div>
      <div class="kanan1">
        <h2>Check Out</h2>
        <p>Pastikan nomor yang diinput aktif dihubungi.</p>
        <p>Alamat pengiriman diisi sesuai dengan format yang tertera.</p>
        <p>Cek kembali pesanan Anda kemudian lanjutkan pemesanan.</p>
      </div>
    </div>
    <div class="p2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <div class="kanan1">
        <h2>Lakukan Pembayaran</h2>
        <p>Lakukan pembayaran sesuai nomer rekening yang tertera pada nota.</p>
        <p>Pastikan Anda mentransfer sejumlah grand total.</p>
      </div>
      <div class="kiri1">
        <img src="./Foto/h5.jpg" class="img-1">
      </div>
    </div>
    <div class="p1" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="400">
      <div class="kiri1">
        <img src="./Foto/riwayat.jpeg" class="img-1">
      </div>
      <div class="kanan1">
        <h2>Pesanan</h2>
        <p>Buka fitur pesanan dan cek riwayat pesanan Anda.</p>
        <p>Anda dapat melihat riwayat pemesanan yang telah Anda lakukan.</p>
        <p>Pilih tombol pembayaran untuk langkah selanjutnya.</p>
      </div>
    </div>
    <div class="p2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
      <div class="kanan1">
        <h2>Upload Bukti Pembayaran</h2>
        <p>Lakukan konfirmasi pembayaran.</p>
        <p>Upload bukti transfer Anda sesuai format yang telah ditentukan.</p>
        <p>Pastikan Anda melakukan konfirmasi pembayaran tidak lebih dari 24 jam waktu pemesanan.</p>
      </div>
      <div class="kiri1">
        <img src="./Foto/fix8.jpg" class="img-1">
      </div>
    </div>
    <div class="p1" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="400">
      <div class="kiri1">
        <img src="./Foto/fix9Y.jpg" class="img-1">
      </div>
      <div class="kanan1">
        <h2>Cek Status Pesanan</h2>
        <p>Setelah konfirmasi pembayaran, pastikan status pesanan Anda <br>telah berubah.</p>
        <p>Lakukan pengecekan status pesanan Anda secara berkala</p>
      </div>
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
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>