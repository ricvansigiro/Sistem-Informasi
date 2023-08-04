<?php
require './controller/connection.php';
require './controller/barang-jenis.php';

if(!isset($_SESSION['log'])){
    redirect('/pages/shared/login.php');
}
if(isset($_SESSION['isAdmin'])){
    redirect('/pages/admin');
}
if(isset($_SESSION['isUser'])){
    redirect('/pages/user');
}
?>