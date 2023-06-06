<?php

require './function.php';

$id= $_GET["id"];

if(hapusStatus($id)>0){
    echo "
        <script>
            alert('Berhasil dihapus');
            document.location.href = 'chart.php';   
        </script>
    ";
}
else{
    echo "
    <script>
        alert('Gagal dihapus');
        document.location.href = 'chart.php'; 
    </script>
";
}
?>