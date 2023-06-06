<?php

require './function.php';

$id= $_GET["id"];

if(hapusUser($id)>0){
    echo "
        <script>
            alert('Berhasil dihapus');
            document.location.href = 'index.php';   
        </script>
    ";
}
else{
    echo "
    <script>
        alert('Gagal dihapus');
        document.location.href = 'index.php'; 
    </script>
";
}
?>