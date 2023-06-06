<?php
include 'function.php';
session_start();
$id_user = $_SESSION['login'];

if( !isset($id_user)){
    header('Location: signin.php');
    exit;
}