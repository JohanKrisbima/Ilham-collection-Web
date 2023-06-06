<?php

include './function.php';
session_start();

$id_pakaian = $_GET['id'];

$id_admin = $_SESSION['admin'];

if( !isset($id_admin)){
    header('Location: signin.php');
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'") or die ('query failed');
if(mysqli_num_rows($select)>0){
  $fetch = mysqli_fetch_assoc($select);
}

$pakaian = query("SELECT * FROM pakaian WHERE id_pakaian = $id_pakaian")[0];

if(isset($_POST['submit'])){
    if(ubahPakaian($_POST)>0){
      echo "<script>alert(' Data berhasil diUpdate')</script>";
      echo "<script>location= 'index.php'</script>";
  
    }
    else{
      echo "<script>alert(' Data Gagal diUpdate')</script>";  
      echo "<script>location= 'index.php'</script>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="../Foto/">
</head>
<body>
<h1>Ubah Data Pakaian</h1>
<pre><?php print_r($pakaian)?></pre>

<form action="" method="POST" enctype="multipart/form-data">
<ul>
    <li>
        <label for="jenis">Jenis Pakaian : </label>
        <input type="text" name="jenis" id="jenis" required value="<?= $pakaian['jenis']?>">
    </li>
    <li>
        <label for="nama">Nama Pakaian : </label>
        <input type="text" name="nama" id="nama" required value="<?= $pakaian['nama']?>">
    </li>
    <li>
        <label for="warna">Warna Pakaian : </label>
        <input type="text" name="warna" id="warna" required value="<?= $pakaian['warna']?>">
    </li>
    <li>
        <label for="harga">Harga Pakaian : </label>
        <input type="text" name="harga" id="harga" required value="<?= $pakaian['harga']?>">
    </li>
    <li>
        <label for="ukuran">Ukuran Pakaian : </label>
        <select name="ukuran" id="ukuran" required>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
    </li>
    <li>
        <label for="bahan">Bahan Pakaian : </label>
        <input type="text" name="bahan" id="bahan" required value="<?= $pakaian['bahan']?>"> 
    </li>
    <li>
        <label for="stok">Stok Pakaian : </label>
        <input type="text" name="stok" id="stok" required value="<?= $pakaian['stok']?>">
    </li>
    <li>
        <label for="keunggulan">Keunggulan Pakaian : </label>
        <textarea name="keunggulan" id="keunggulan" cols="30" rows="10" required><?= $pakaian['keunggulan']?></textarea>
    </li>
    <li>
        <label for="gambar">Gambar Pakaian : </label>
        <input type="file" accept=".jpg, .jpeg, .png" name="gambar" id="gambar">
        <input type="hidden" name="id_pakaian" value="<?= $pakaian['id_pakaian']?>">
        <input type="hidden" name="gambarLama" value="<?= $pakaian['gambar']?>">
    </li>
    <li>
        <button type="submit" name="submit" >Submit Data</button>
    </li>
</ul>
</form>

</body>
</html>