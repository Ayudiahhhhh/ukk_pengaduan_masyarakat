<?php
include('../../database/koneksi.php');

function register($form)
{
  global $conn;

  // Cek di tabel masyarakat
  // "b", "d", "i", "s
  $sql = "SELECT * FROM masyarakat WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $form['username']);
  $stmt->execute();
  $result = $stmt->get_result();
  // var_dump($result);
  // die;
  if ($result->num_rows > 0) {
    echo "<script> alert('username sudah terdaftar')</script>";
    return false;
  }

  $sql = "SELECT * FROM masyarakat WHERE nik = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $form['nik']);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    echo "<script> alert('data andasudah terdaftar')</script>";
    return false;
  }

  $sql = "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) 
  VALUES ('" . mysqli_real_escape_string($conn, $form['nik']) . "', 
          '" . mysqli_real_escape_string($conn, $form['nama']) . "', 
          '" . mysqli_real_escape_string($conn, $form['username']) . "', 
          '" . password_hash(mysqli_real_escape_string($conn, $form['password']), PASSWORD_DEFAULT) . "', 
          '" . mysqli_real_escape_string($conn, $form['telp']) . "')";

  if (mysqli_query($conn, $sql)) {
    return true; // Berhasil
  } else {
    return false; // Gagal
  }
}
