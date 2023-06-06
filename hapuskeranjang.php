<?php
session_start();

$id_pakaian = $_GET['id'];
unset($_SESSION['keranjang'][$id_pakaian]);

echo "<script>alert('Produk dihapus dari keranjang')</script>";
echo "<script>location= 'cart.php';</script>"; 


?>