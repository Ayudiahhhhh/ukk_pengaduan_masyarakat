<?php
include('../../database/koneksi.php');

function get($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);

  // Cek apakah query berhasil
  if (!$result) {
    // Menangani kesalahan jika query gagal
    echo "Error: " . mysqli_error($conn);
    return [];
  }

  $rows = [];
  // Ambil data baris
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}



function tambah($post)
{

  global $conn;
  $sql = "INSERT INTO `users`(`nama_petugas`, `username`, `password`, `telp`, `level`)  
  VALUES ('" . mysqli_real_escape_string($conn, $post['nama_petugas']) . "', 
          '" . mysqli_real_escape_string($conn, $post['username']) . "', 
          '" . password_hash(mysqli_real_escape_string($conn, 123), PASSWORD_DEFAULT) . "', 
          '" . mysqli_real_escape_string($conn, $post['telp']) . "', 
          '" . mysqli_real_escape_string($conn, $post['level']) . "')";

  // var_dump($sql);
  // die;
  if (mysqli_query($conn, $sql)) {
    return true; // Berhasil
  } else {
    return false; // Gagal
  }
}
function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM `users` WHERE id_petugas = '$id'");
  // var_dump($id);
  // die;
  return true;
}



function ubah($data, $id)
{
  
  global $conn;
  $nama_petugas = htmlspecialchars($data["nama_petugas"]);
  $username = htmlspecialchars($data["username"]);
  $telp = htmlspecialchars($data["telp"]);
  
  if ($data['username_lama'] != $data['username']) {



    // Cek di tabel users
    // "b", "d", "i", "s
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $data['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    // var_dump($result);
    // die;
    if ($result->num_rows > 0) {
      echo "<script> alert('username sudah terdaftar')</script>";
      return false;
    }

  }

  
  $query = "UPDATE `users` SET 
         nama_petugas = '$nama_petugas',
          username =' $username',
         telp = '$telp'
          WHERE id_petugas = $id
  ";
 
  mysqli_query($conn, $query);

  return true;
}
