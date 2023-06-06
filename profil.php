<?php
include 'function.php';
session_start();
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}


$user = query("SELECT * FROM user WHERE id_user = $id_user")[0];



// if(isset($_POST['update_profile'])){
//   // $update_username = strtolower(stripslashes($_POST['update_username']));
//   $update_name = mysqli_real_escape_string($conn, $_POST['update_nama']);
//   $update_email =  mysqli_real_escape_string($conn, $_POST['update_email']);
//   $update_alamat =  mysqli_real_escape_string($conn, $_POST['update_alamat']);
//   $update_telepon =  mysqli_real_escape_string($conn, $_POST['update_tel']);

//     or die('query failed');



// }
if(isset($_POST['submit'])){
  if(ubah($_POST)>0){
    echo "<script>alert(' Data berhasil diUpdate')</script>";
    echo "<script>location= 'home.php'</script>";

  }
  else{
    echo "<script>alert('Tidak ada data yang diubah')</script>";
    echo "<script>location= 'home.php'</script>";
  }
}

?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ilham Collection</title>
  <link rel="stylesheet" href="./CSS/profil.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
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
            <!-- <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a> -->
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
      </ul>
    </nav>
  </div>

 

  <!-- LAYOUT KE DUA -->
  <div class="wadah">
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="container"> 
      <div class="grid">   
        <div class="pembatas1">
          <h2>My Profile</h2>
          <p>Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun</p>
          <br><hr>
      
            <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" readonly value="<?php echo $user['username']?>"></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?= $user['nama_lengkap']?>" required autocomplete="off"></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="<?= $user['email']?>" required autocomplete="off"></td>
              </tr>
              <tr>
                <td>Nomor Telepon</td>
                <td><input type="number" name="telepon" value="<?= $user['telepon'] ?>" required autocomplete="off"></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" placeholder=" No. Rumah, Nama Jalan, Provinsi, Kota, Kecamatan, Kode Pos, (Patokan optional)" required autocomplete="off"><?= $user['alamat']?></textarea></td>
              </tr>
              <input type="hidden" name="id_user" value="<?= $user['id_user']?>">
              <input type="hidden" name="gambarLama" value="<?= $user['gambar']?>">
            </table>
         
          
            <div class="btn">
            <button class="simpan" name="submit" type="submit">Simpan</button>
            </div>       
        </div>  

        <div class="pembatas2">
          <div class="wrapper">
          <?php if($user['gambar'] == ''):?>
            <img src="./Foto/user.png" class="photo">
          <?php else:?>
            <img src="./foto_uploud/<?= $user['gambar']?>" class="photo">
          <?php endif;?>
            <input type="file" accept=".jpg, .jpeg, .png" name="gambar" class="my_file">
          </div>
          <p>Format gambar: .JPG, .JPEG, .PNG</p>
        </div>
      </div>
    </div>
    </form>
  </div>
  <!-- <div class="bawah">
    <p>Tempat footer tapi sek gaisok nerapno:)</p>
        </div> -->
</body>

</html>