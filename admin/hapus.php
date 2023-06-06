<?php

require './function.php';

$id= $_GET["id"];

if(hapus($id)>0){
    echo "
        <script>
            alert('Berhasil dihapus');
            document.location.href = 'allproduk.php';   
        </script>
    ";
}
else{
    echo "
    <script>
        alert('Gagal dihapus');
        document.location.href = 'allproduk.php'; 
    </script>
";
}
?>