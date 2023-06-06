<?php
include 'function.php';
$id_pakaian = $_GET['id'];
session_start();
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}

// query 
$ambil = $conn ->query("SELECT * FROM pakaian WHERE id_pakaian = '$id_pakaian'");
$detail = $ambil -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/detailProduct.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
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

        <!-- LAYOUT KE DUA -->
    </div>
    <div class="wadah">
        <div class="container">
            <div class="product-container">
                <div class="product-image">
                    <img src="./Foto/<?= $detail['gambar']?>" class="product-thumb" alt="">
                </div>
            </div>
            <div class="detail">
                <div class="nama-product">
                    <!-- <p>Coeg</p> -->
                    <h1><?= $detail['nama']?></h1>
                    <p><?= $detail['keunggulan']?></p>
                </div>
                <form action="" method="POST">
                    <br>
                    <div class="kuantitas">
                        <p>Stok : <?= $detail['stok']?></p>                   
                    </div>
                    <div class="kuantitas">
                        <p>Kuantitas</p>                   
                        <input class="num" type="number" min="1"  max="<?= $detail['stok']?>" value="1" name="jumlah">
                    </div>
                    <br>
                    <h3>Rp. <?= number_format($detail['harga']) ?></h3>
                    <br>
                    <button class="btn-cart" name="beli"><i class="fa-solid fa-cart-plus"></i> Masukkan Keranjang</button>
                </form>

                <?php 
                // jika ada tombol beli 
                if(isset($_POST["beli"])){
                    // mendapatkan jumlah yang di inputkan
                    $jumlah = $_POST['jumlah'];
                    // $size = $_POST['size'];

                    // masukkan di keranjang belanja
                    $_SESSION['keranjang'][$id_pakaian] = $jumlah ;
                    // $_SESSION['cart'][$id_pakaian]= $size ;

                    echo "<script>alert('Pakaian berhasil ditambahkan ke keranjang')</script>";
                    echo "<script>location= 'cart.php'</script>";
                }
                ?>
                <!-- <button class="btn-buy">Beli Sekarang</button> -->
            </div>
        </div>
    </div>

    <!-- Spesifikasi Produk -->
    <div class="wadah1">
        <div class="container1">
            <div class="detail1">
               
                <br>
                <div class="deskripsi">
                    <h3>Deskripsi Produk</h3>
                    <p>Warna: <?= $detail['warna']?></p>
                    <p>Bahan: <?= $detail['bahan']?></p>
                    <p>Ukuran: <?= $detail['ukuran']?></p>
                    <br>
                    <span><strong>Informasi Ukuran Baju</strong> 
                        <p>Size S: bahu 42cm, dada 48cm, panjang 66cm </p>
                        <p>Size M: bahu 45cm, dada 50cm, panjang 68cm </p>
                        <p>Size L: bahu 47cm, dada 53cm, panjang 70cm </p>
                        <p>Size XL: bahu 50cm, dada 55cm, panjang 72cm </p>
                    </span>
                    <br>
                    <br>
                    <span><strong>Informasi Ukuran Celana</strong>
                        <p>Size 27: tinggi 65-67cm, pinggang 26-27cm, pinggul 33-35cm, inseam 30-31cm </p>
                        <p>Size 28-30: tinggi 68-70cm, pinggang 28-31cm, pinggul 36-38cm, inseam 31-32cm </p>
                        <p>Size 31-33: tinggi 70-73cm, pinggang 31-33cm, pinggul 38-39cm, inseam 32-33cm </p>
                        <p>Size 34-36: tinggi 71-74cm, pinggang 34-36cm, pinggul 40-41cm, inseam 32-33cm </p>
                        <p>Size 38-40: tinggi 73-75cm, pinggang 37-40cm, pinggul 42-43cm, inseam 34cm </p>
                        <p>Size 40-42: tinggi 73-75cm, pinggang 40-42cm, pinggul 44-45cm, inseam 34cm </p>
                    </span>
                    <br>
                </div>
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
</body>

</html>