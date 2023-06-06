<?php
session_start();
include 'function.php';
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}
?>

<?php
    $select = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'") or die ('query failed');
    if(mysqli_num_rows($select)>0){
        $fetch = mysqli_fetch_assoc($select);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilham Collection</title>
    <link rel="stylesheet" href="./css/riwayat.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c6d8f06459.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../Foto/logo3.png" type="image/x-icon" />
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
                <h1>Riwayat Pesanan</h1>
                <!-- TABEL -->
                <table>
                    <!-- JUDUL KOLOM -->
                    <th>No. Pesanan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th class="opsi">Opsi</th>
                    <!-- BARIS DATA -->
                    <?php
                    // mendapatkan id user yang login
                    $id_user = $id_user;

                    $ambil = $conn->query("SELECT * FROM pembelian WHERE id_user = '$id_user' ORDER BY id_pembelian DESC");
                   
                    while( $pecah = $ambil->fetch_assoc()):        
                    ?>
                   
                    <tr>
                        <td><?= $pecah['id_pembelian']?></td>
                        <td><?= $pecah['tanggal_pembelian']?></td>
                        <td>Rp.<?= number_format($pecah['total_pembelian'])?></td>
                        
                        <td><?= $pecah['status_pembelian']?></td>
                        <td style="display: flex;">
                            <a href="nota.php?id=<?= $pecah['id_pembelian']?>"><Button class="nota">Nota</Button></a>
                            <?php if($pecah['status_pembelian'] == "Belum Dibayar"):?>
                            <a href="pembayaran.php?id=<?= $pecah['id_pembelian']?>"><Button class="pay">Pembayaran</Button></a>
                            <?php endif;?>
                            <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $pecah['id_pembelian']?>">    
                            <?php if($pecah['status_pembelian'] == "Sampai Ditujuan"):?>
                            <Button class="pay" name="submit">Konfirmasi Barang</Button>
                            <?php endif;?>
                            </form>
                            
                        </td>
                    </tr>
                    
                    <?php endwhile;?>
                </table>
                <div class="bawah">
                <div class="panduan">
                    <p class="panduan1">Panduan!</p>
                    <p>1. Cek nota digital pesanan Anda pada tombol nota.</p>
                    <p>2. Upload bukti transfer berupa screenshoot atau foto slip pembayaran pada tombol pembayaran.</p>
                    <p>3. Kenali Status Pesanan sebelum Anda melakukan proses penyelesaian pesanan.</p>
                </div>
                      <div class="arti">
                        <p class="arti1">Kenali Status Pesanan Anda!</p>
                        <img src="./Foto/status2.png">
                    <!-- <p>Status Pesanan</p>
                    <p>Belum Bayar<br>Menunggu konfirmasi bukti pembayaran.</p>
                    <p>Dikemas<br>Pesanan sedang dikemas Penjual.</p>
                    <p>Dikirim<br>Pesanan sedang dalam proses pengiriman.</p>
                    <p>Selesai <br>Pesanan sudah diterima oleh Pembeli</p> -->
                </div>
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

    <?php
    if(isset($_POST['submit'])){
        $idpem = $_POST['id'];

        $conn->query("UPDATE pembelian SET status_pembelian='Selesai' WHERE id_pembelian='$idpem'");
        echo "<script>alert('Terimakasih Sudah Belanja Di Ilham Collection')</script>";
        echo "<script>location= 'riwayat.php'</script>";
    }
    ?>

</body>

</html>