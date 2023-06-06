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

function registrasi($data){
    global $conn;

    $email = mysqli_real_escape_string($conn, $data['email']) ;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn,$data['password']);
    $password2 = mysqli_real_escape_string($conn,$data['password2']);

    // cek username sudah ada atau belum
    $result= mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah terdaftar!');
             </script>";
             return false;
    }

    // cek konfirmasi password 
    if($password !== $password2){
        echo "
            <script>
                alert('konfirmasi password tidak sesuai');
            </script>           
        ";
        return false;
    }
    
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$email', '$username', '$password', '', '', '', '')");
    
    return mysqli_affected_rows($conn);

}


function ubah($data){
    global $conn;
    $id_user = $data['id_user'];
    $email = htmlspecialchars($data['email']);
    $nama = htmlspecialchars($data['nama']);
    $telepon = htmlspecialchars($data['telepon']);
    $alamat = htmlspecialchars($data['alamat']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }
    //upload gambar

    $query= "UPDATE user SET 
               email = '$email', nama_lengkap = '$nama', telepon = '$telepon', alamat='$alamat', gambar='$gambar' WHERE id_user = $id_user ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}



function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar)) ;
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, './foto_uploud/' . $namaFileBaru);

    return $namaFileBaru;
}
?>

