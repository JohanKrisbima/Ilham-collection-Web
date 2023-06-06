<?php

include '../function.php';
session_start();
$id_admin = $_SESSION['admin'];

if( !isset($id_admin)){
    header('Location: signin.php');
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'") or die ('query failed');
if(mysqli_num_rows($select)>0){
  $fetch = mysqli_fetch_assoc($select);
}

// if(isset($_POST["submit"])){
//     if(tambah($_POST) > 0){
//         echo "
//             <script>
//                 alert('data berhasil ditambah');
//                 document.location.href= 'index.php';
//             </script>
//         ";
//     }
//     else{
//         echo "
//         <script>
//             alert('data gagal ditambah');
//             document.location.href= 'index.php';
//         </script>
//     ";
//     }
// }

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
<h1>Tambah Data Pakaian</h1>

<form action="" method="POST" enctype="multipart/form-data">
<ul>
    <li>
        <label for="jenis">Jenis Pakaian : </label>
        <input type="text" name="jenis" id="jenis" required>
    </li>
    <li>
        <label for="nama">Nama Pakaian : </label>
        <input type="text" name="nama" id="nama" required>
    </li>
    <li>
        <label for="warna">Warna Pakaian : </label>
        <input type="text" name="warna" id="warna" required>
    </li>
    <li>
        <label for="harga">Harga Pakaian : </label>
        <input type="text" name="harga" id="harga" required>
    </li>
    <li>
        <label for="ukuran">Ukuran Pakaian : </label>
        <select name="ukuran" id="ukuran">
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
    </li>
    <li>
        <label for="bahan">Bahan Pakaian : </label>
        <input type="text" name="bahan" id="bahan" required> 
    </li>
    <li>
        <label for="stok">Stok Pakaian : </label>
        <input type="text" name="stok" id="stok" required>
    </li>
    <li>
        <label for="keunggulan">Keunggulan Pakaian : </label>
        <textarea name="keunggulan" id="keunggulan" cols="30" rows="10" required></textarea>
    </li>
    <li>
        <label for="gambar">Gambar Pakaian : </label>
        <input type="file" name="gambar" id="gambar" required>
   
    </li>
    <li>
        <button type="submit" name="submit" >Submit Data</button>
    </li>
</ul>
</form>

<?php
    if(isset($_POST['submit'])){
        // upload dulu foto bukti 
        $namaBukti = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $lokasiBukti = $_FILES["gambar"]["tmp_name"];

            // cek eror
        if($error === 4){
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
        }

        $namaFiks = date("YmdHis").$namaBukti;
        move_uploaded_file($lokasiBukti,"../Foto/$namaFiks");

        $jenis = htmlspecialchars($_POST['jenis']); 
        $nama = htmlspecialchars( $_POST['nama']);
        $warna = htmlspecialchars($_POST['warna']);
        $harga = htmlspecialchars($_POST['harga']);
        $ukuran = htmlspecialchars($_POST['ukuran']);
        $bahan = htmlspecialchars($_POST['bahan']);
        $stok = htmlspecialchars($_POST['stok']);
        $keunggulan = htmlspecialchars($_POST['keunggulan']);

        // simpan pembayaran
        // $conn->query("INSERT INTO pakaian(id_pakaian, jenis, nama, warna, harga, keunggulan, ukuran, bahan, gambar, stok) 
        // VALUES('', '$jenis', '$nama', '$warna', '$harga', '$keunggulan', '$ukuran', '$bahan', '$namaFiks', '$stok')");
        mysqli_query($conn, "INSERT INTO pakaian VALUES('', '$jenis', '$nama', '$warna', '$harga', '$keunggulan', '$ukuran', '$bahan', '$namaFiks', '$stok')");

        echo "<script>alert('Data Pakaian Berhasil Ditambahkan')</script>";
        echo "<script>location= 'index.php'</script>";
    }   
?>
</body>
</html>