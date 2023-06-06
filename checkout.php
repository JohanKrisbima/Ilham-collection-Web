<?php
session_start();

include 'function.php';
$id_user =$_SESSION['login'];

$select = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'") or die ('query failed');
if(mysqli_num_rows($select)>0){
$fetch = mysqli_fetch_assoc($select);
}

if( !isset($_SESSION['keranjang']) or empty($_SESSION['keranjang'])){
   echo "<script>alert('Belum ada pakaian yang kamu masukkan keranjang')</script>";
   echo "<script>location= 'home.php';</script>";
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilham Collection</title>
    <link rel="stylesheet" href="./css/chekout.css" />
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

    <section>
        <form  action="" method="POST">
        <div class="wadah">
            <div class="logo">
            <img src="./Foto/logo3.png" class="logo3">
            <h1>| Chek Out</h1>
            </div>
            <div class="container">
                    <div class="grid1">
                        <div class="p1">
                            <div class="kanan">
                                <p class="alamat"> <i class="fa fa-map-marker"></i> Alamat Pengiriman</p>
                                <input type="text" class="nama"  name="nama_pembeli" value="<?= $fetch['nama_lengkap']?>" required autocomplete="off" placeholder="Nama Penerima">
                            </div>
                            <div class="kiri">
                                <input type="number" class="nama" name="telepon" value="<?= $fetch['telepon']?>" required autocomplete="off" placeholder="No.telepon">
                            </div>
                        </div>
                        <div class="p2">
                            <textarea class="alamat1" name="alamat_pengiriman" id="alamat" placeholder=" No. Rumah, Nama Jalan, Provinsi, Kota, Kecamatan, Kode Pos, (Patokan optional)" required autocomplete="off"><?= $fetch['alamat']?></textarea>
                        </div>
                    </div>
            </div>
        </div>

        <?php $total_belanja= 0;?>   
        <?php foreach($_SESSION['keranjang'] as $id_pakaian => $jumlah) :?>
            <?php
             $ambil = $conn->query("SELECT * FROM pakaian WHERE id_pakaian = '$id_pakaian'");
             $pecah = $ambil->fetch_assoc();
             $subharga = $pecah['harga']*$jumlah;
            ?>
        <div class="wadah1">
            <div class="container">
                <div class="grid">
                    <div class="atas">
                        <p><i class="fa-solid fa-clipboard-list"></i> Produk Dipesan</p>
                        <hr>
                    </div>
                    <div class="isi">
                        <div class="p3">
                            <img src="./Foto/<?= $pecah['gambar']?>" class="photo">
                        </div>
                        <div class="p4">
                            <p class="nama-product"><?= $pecah['nama']?></p>
                        </div>
                        <div class="p8">
                            <span>
                                <p>Ukuran</p>
                            </span>
                            <p><?= $pecah['ukuran']?></p>
                        </div>
                        <div class="p5">
                            <span>
                                <p>Harga Satuan</p>
                            </span>
                            <p> Rp. <?= number_format($pecah['harga'])?></p>
                        </div>
                        <div class="p6">
                            <span>
                                <p>
                                    Kuantitas
                                </p>
                            </span>
                            <p> <?= $jumlah?></p>
                        </div>
                        <div class="p7">
                            <span>
                                <p> Sub Total</p>
                            </span>
                            <p> Rp. <?= number_format($subharga)?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $total_belanja+=$subharga;?>
        <?php endforeach;?> 

        <div class="wadah2">
            <div class="container2">
                <div class="grid2">
                    <div class="atas2">
                  
                    <div class="isi2">
                        <div class="p9">
                            <!-- <p>Kosong</p> -->
                        </div>
                        <div class="p10">
                            <div class="d1">
                                <p>Subtotal Produk</p>
                               <p>Pilih Opsi Pengiriman</p> 
                               <p>Pembayaran</p>
                            </div>
                            <div class="d2">
                                <p>Rp <?= number_format($total_belanja)?></p>
                                <select name="id_ongkir">
                                <?php
                                    $ongkir = query("SELECT * FROM ongkir")  ;            
                                ?>
                                <?php foreach($ongkir as $kirim):?>
                                <option value="<?= $kirim['id_ongkir']?>">
                                     <?= $kirim['area']?> - Rp.<?= number_format($kirim['tarif'])?> 
                                </option>
                                <?php endforeach;?>
                            </select>
                        <p>Transfer Bank (ONLY)</p>
                        
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="p11">
                        <div class="d3">

                        </div>
                        <div class="d4">
                            <button class="pesan" name="checkout">Buat Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>
    
                        <?php
                            if(isset($_POST['checkout'])){
                                $id_users = $fetch['id_user'];
                                $id_ongkir = $_POST['id_ongkir']; 
                                $tanggal_pembelian = date("Y-m-d");
                                $alamat_pengiriman =  $_POST['alamat_pengiriman'];
                                $nama_pembeli = $_POST['nama_pembeli'];
                                $telepon = $_POST['telepon'];

                                $ambil = $conn->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                                $arrayongkir = $ambil->fetch_assoc();
                                $tarif = $arrayongkir['tarif'];
                                $area = $arrayongkir['area'];
                                $total_pembelian = $total_belanja+$tarif;
                                
                                // menyimpan data ke tabel pembelian
                                $conn->query("INSERT INTO pembelian (id_user, id_ongkir, tanggal_pembelian,total_pembelian, area, tarif, alamat_pengiriman, nama_pembeli, telepon_pembeli) VALUES ('$id_users', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$area', '$tarif', '$alamat_pengiriman', '$nama_pembeli', '$telepon')");

                                // mendapatkan id_pembelian barusan terjadi
                                $id_pembelian_barusan = $conn->insert_id;

                                foreach($_SESSION['keranjang'] as $id_pakaian=>$jumlah){
                                    // mendapatkan data produk berdasarkan id_pakaian
                                    $ambil= $conn->query("SELECT * FROM pakaian WHERE id_pakaian='$id_pakaian'");
                                    $perproduk= $ambil->fetch_assoc();

                                    $nama = $perproduk['nama'];
                                    $ukuran = $perproduk['ukuran'];
                                    $harga = $perproduk['harga'];
                                    $gambar = $perproduk['gambar'];
                                    $subharga =$perproduk['harga']*$jumlah;
                                    $conn->query("INSERT INTO pembelian_pakaian (id_pembelian, id_pakaian, nama, ukuran, harga, subharga, jumlah , gambar)
                                    VALUES ('$id_pembelian_barusan', '$id_pakaian', '$nama', '$ukuran', '$harga','$subharga', '$jumlah' , '$gambar')");

                                    // skrip update stok
                                    $conn->query("UPDATE pakaian SET stok = stok-$jumlah WHERE id_pakaian='$id_pakaian'");
                                }

                                // mengosongkan keranjang belanja
                                unset($_SESSION['keranjang']);

                                // tampilan di alihkan ke halaman nota, nota dari pembelian yang barusan
                                echo "<script>alert('Pembelian sukses')</script>";
                                echo "<script>location= 'nota.php?id=$id_pembelian_barusan';</script>";
                                
                            }
                        ?>

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