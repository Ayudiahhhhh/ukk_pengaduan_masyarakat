<?php
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


function tambah($form)
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
    echo "<script> alert('data anda sudah terdaftar')</script>";
    return false;
  }

  $sql = "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) 
  VALUES ('" . mysqli_real_escape_string($conn, $form['nik']) . "', 
          '" . mysqli_real_escape_string($conn, $form['nama']) . "', 
          '" . mysqli_real_escape_string($conn, $form['username']) . "', 
          '" . password_hash(mysqli_real_escape_string($conn, 123), PASSWORD_DEFAULT) . "', 
          '" . mysqli_real_escape_string($conn, $form['telp']) . "')";

  if (mysqli_query($conn, $sql)) {
    return true; // Berhasil
  } else {
    return false; // Gagal
  }
}


function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM masyarakat WHERE nik=$id");

  return true;
}



function ubah($data, $nik){
  
  global $conn;
  $nik_new = $data["nik"];
  $nik = htmlspecialchars($data["nik"]);
  $nama = htmlspecialchars($data["nama"]);
  $username = htmlspecialchars($data["username"]);
  $username_lama = htmlspecialchars($data["username_lama"]);
  $telp = htmlspecialchars($data["telp"]);

if ($username != $username_lama) {
  $sql = "SELECT * FROM masyarakat WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $data['username']);
  $stmt->execute();
  $result = $stmt->get_result();}
  // var_dump($result);
    // die;
  if ($result->num_rows > 0) {
    echo "<script> alert('username sudah terdaftar')</script>";
    return false;
  }

  if($nik != $data['nik']){
    // Cek di tabel masyarakat
    // "b", "d", "i", "s
    $sql = "SELECT * FROM masyarakat WHERE nik = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $data['nik']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      echo "<script> alert('data anda sudah terdaftar')</script>";
      return false;
    }

  }
  

  $query = "UPDATE `masyarakat` SET 
         nik = '$nik_new',
          nama =' $nama',
          username = '$username',
          telp= '$telp'
          WHERE nik = $nik
  ";
 
mysqli_query($conn, $query);

return true;
}





