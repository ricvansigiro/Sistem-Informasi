<?php
session_start();

DEFINE('BASEURL', 'http://localhost:8080/pkl');

function redirect($location){
    header('Location: '. BASEURL . $location);
    exit();
}

$conn = mysqli_connect("localhost","root","","pkl","3307");

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $id_get = mysqli_query($conn, "SELECT id_user FROM users WHERE username = '$username' LIMIT 1");
    $id_array = mysqli_fetch_array($id_get);
    $id_user = $id_array[0];
}
function tanggal_indonesia($tanggal){

	$bulan = array (
		1 =>   	'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
		);

		$var = explode('-', $tanggal);

		return $var[2] . ' ' . $bulan[ (int)$var[1] ] . ' ' . $var[0];
		// var 0 = tanggal
		// var 1 = bulan
		// var 2 = tahun
}

date_default_timezone_set('Asia/Jakarta');
?>