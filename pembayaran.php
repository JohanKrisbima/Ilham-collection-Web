<?php
session_start();

include 'function.php';
$id_user =$_SESSION['login'];

if( !isset($id_user)){
  header('Location: signin.php');
  exit;
}

$select = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'") or die ('query failed');
if(mysqli_num_rows($select)>0){
$fetch = mysqli_fetch_assoc($select);
}

$idpem = $_GET['id'];
$ambil =  $conn->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_user yang beli
$id_user_beli = $detpem['id_user'];

if($id_user_beli !== $id_user){
    echo "<script>alert('JANGAN MENCOBA MENGAKSES YANG BUKAN PUNYA ANDA')</script>";
    echo "<script>location= 'riwayat.php'</script>";
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ilham Collection</title>
  <link rel="stylesheet" href="./CSS/pembayaran.css" />
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
    <!-- LAYOUT KE DUA -->
  </div>
  <div class="wadah">
    <div class="container">
      <div class="conten">
        <h1>Pembayaran</h1>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="p1">
            <p class="no">No. Pesanan <?= $detpem['id_pembelian']?></p>
            <!-- <p class="">Tagihan Rp. 100.000</p> -->
            <hr>
            <table>
              <tr>
                <td>Pembayaran yang perlu diselesaikan</td>
                <td class="grand">Rp. <?= number_format($detpem['total_pembelian']) ?></td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" name="jumlah" value="<?= $detpem['total_pembelian'] ?>">
                </td>
              </tr>
              <tr>
                <td>Nama pemilik rekening Bank</td>
                <td><input type="text" name="atas_nama" required autocomplete="off"></td>
              </tr>
              <tr>
                <td>Transfer dari Bank</td>
                <td><input type="text" name="bank" required autocomplete="off"></td>
              </tr>
              <tr>
                <td>Upload Bukti Pembayaran</td>
                <td><input type="file" accept=".jpg, .jpeg, .png" name="bukti" class="my_file"></td>
              </tr>
            </table>
          </div>
          <div class="info">
         
          <div class="p3">
            <p class="warming">Peringatan!</p>
            <p>1. Segera upload bukti pembayaran melakukan pemesanan.</p>
            <p>2. Upload bukti pembayaran berupa screenshoot atau foto slip pembayaran.</p>
            <p>3. Pastikan status pesanan Anda berubah setelah melakukan konfirmasi pembayaran.</p>
          </div>
          <div class="p2">
            <button class="konfir" name="kirim">Konfirmasi</button>
          </div>
          </div>
    

        </form>
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

  <?php
    if(isset($_POST['kirim'])){
            // upload dulu foto bukti 
            $namaBukti = $_FILES['bukti']['name'];
            $ukuranFile = $_FILES['bukti']['size'];
            $error = $_FILES['bukti']['error'];
            $lokasiBukti = $_FILES["bukti"]["tmp_name"];

            // cek eror
        if($error === 4){
          echo "<script>
          alert('pilih gambar terlebih dahulu');
          </script>";
          return false;
        }
        // $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaBukti);
        $ekstensiGambar = strtolower(end($ekstensiGambar)) ;
            $namaFiks = date("YmdHis").$namaBukti;
            move_uploaded_file($lokasiBukti,"admin/bukti_tf/$namaFiks");

            $nama = $_POST['atas_nama'];
            $bank = $_POST['bank'];
            $jumlah = $_POST['jumlah'];
            $tanggal = date("Y-m-d");

            // simpan pembayaran
            $conn->query("INSERT INTO pembayaran(id_pembelian, atas_nama, bank, jumlah, tanggal, bukti_pembayaran) 
            VALUES('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namaFiks')");

            // update status pembayaran 
            $conn->query("UPDATE pembelian SET status_pembelian='Dikemas' WHERE id_pembelian= '$idpem'");
            echo "<script>alert('Terimakasih Sudah Mengirimkan Bukti Pembayaran')</script>";
            echo "<script>location= 'riwayat.php'</script>";
      }     
  ?>
<a href="admin/bukti_tf/"></a>
</body>
</html>