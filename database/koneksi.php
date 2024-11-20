<?php 
session_start();
$conn = mysqli_connect("localhost","root","","pengaduan_masyarakat");
// $hashed_password = password_hash("123", PASSWORD_DEFAULT);
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>