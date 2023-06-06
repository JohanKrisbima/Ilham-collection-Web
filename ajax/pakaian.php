<?php
require '../function.php';

$keyword = $_GET['keyword'];

$query =  "SELECT * FROM pakaian WHERE
         jenis LIKE '%$keyword%' OR
         nama LIKE '%$keyword%' 
         ";
$pakaian = mysqli_query($conn,$query);
$hitungdata = mysqli_num_rows($pakaian);

?>

<div class="product-container">

      <!-- Card -->
      <?php foreach($pakaian as $p):?>
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

    <div class="null" style="display: inline-blok; text-align:center; margin-bottom:20px;">
   <?php if($hitungdata == 0):?>
    <h3>Ups, produk yang kamu cari belum tersedia nih.</h3>
    <h3> Silahkan melakukan pencarian produk lainnya. Happy shopping!</h3>
   <?php endif;?>
    </div>
   
    
  </div>
  