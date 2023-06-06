<?php
$conn = mysqli_connect("localhost", "root", "", "dbgi");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }   
    return $rows;
}

function ubahPakaian($data){
    global $conn;
    $id_pakaian = $data['id_pakaian'];
    $jenis = htmlspecialchars($data['jenis']); 
    $nama = htmlspecialchars( $data['nama']);
    $warna = htmlspecialchars($data['warna']);
    $harga = htmlspecialchars($data['harga']);
    $ukuran = htmlspecialchars($data['ukuran']);
    $bahan = htmlspecialchars($data['bahan']);
    $stok = htmlspecialchars($data['stok']);
    $keunggulan = htmlspecialchars($data['keunggulan']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if($_FILES['gambar']['error']===4){
        $gambar = $gambarLama;
    }else{
        $gambar = uploadPakaian();
    }
    //upload gambar

    $query= "UPDATE pakaian SET 
             jenis = '$jenis', nama = '$nama', warna = '$warna', harga='$harga', ukuran = '$ukuran', bahan = '$bahan', stok = '$stok', keunggulan = '$keunggulan', gambar='$gambar' WHERE id_pakaian = $id_pakaian ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
function uploadPakaian(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
 
    // cek eror
    // if($error === 4){
    //     echo "<script>
    //     alert('pilih gambar terlebih dahulu');
    //     </script>";
    //     return false;
    // }

    // cek apakah yang diupload adalah gambar
    // $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar)) ;
    // if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
    //     echo "<script>
    //     alert('Yang anda upload bukan gambar');
    //     </script>";
    //     return false;
    // }

    // cek jika ukuran terlalu besar
    // if($ukuranFile > 1000000){
    //     echo "<script>
    //     alert('ukuran gambar terlalu besar');
    //     </script>";
    //     return false;
    // }

    // lolos pengecekan , gambar siap diapload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../Foto/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id){
    global $conn;
    $query = "DELETE FROM pakaian WHERE id_pakaian= $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn); 
}

function hapusUser($id){
    global $conn;
    $query = "DELETE FROM user WHERE id_user= $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn); 
}

function ubahStatus($data){
    global $conn;
    $id_pembelian = $data['id_pembelian'];
    $status = htmlspecialchars($data['status']);

    $query = "UPDATE pembelian SET 
              status_pembelian = '$status' WHERE id_pembelian =  $id_pembelian ";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusStatus($id){
    global $conn;
    $query = "DELETE pembelian,pembelian_pakaian FROM pembelian INNER JOIN pembelian_pakaian ON pembelian.id_pembelian=pembelian_pakaian.id_pembelian WHERE pembelian.id_pembelian = $id ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn); 
}

?>
