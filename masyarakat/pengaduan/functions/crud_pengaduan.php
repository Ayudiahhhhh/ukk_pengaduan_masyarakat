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



function tambah($post, $file)
{
  global $conn;

  $filePath = '/opt/lampp/htdocs/pengaduan_masyarakat/assets/images/pengaduan/';

  $newFileName = time(); // Nama baru berdasarkan timestamp dan nama asli



  // Memeriksa tipe file
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($file['type'], $allowedTypes)) {
    return false;
  }

  // Mengatur jalur lengkap untuk file yang akan disimpan
  $targetFilePath = $filePath . $newFileName;
  // var_dump($_SESSION);
  // die;
  // Memindahkan file ke direktori tujuan
  if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
    // echo 'File uploaded successfully as ' . $newFileName;

    $sql = "INSERT INTO `pengaduan`( `status`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`) 
    VALUES ('0', 
          '" . mysqli_real_escape_string($conn, $post['tgl_pengaduan']) . "', 
          '" . mysqli_real_escape_string($conn, $_SESSION['user']['nik']) . "', 
          '" . mysqli_real_escape_string($conn, $post['isiaduan']) . "', 
          '" . mysqli_real_escape_string($conn, $newFileName) . "')";

    // var_dump($sql);
    // die;
    if (mysqli_query($conn, $sql)) {
      return true; // Berhasil
    } else {
      return false; // Gagal
    }
  } else {
    return false;
  }
}



function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM `pengaduan` WHERE id_pengaduan=$id");

  return true;
}



function ubah($data, $file)
{


  global $conn;
  $id_pengaduan = htmlspecialchars($data["id_pengaduan"]);
  $tgl_pengaduan = htmlspecialchars($data["tgl_pengaduan"]);
  $nik = $_SESSION["user"]["nik"];
  $isiaduan = htmlspecialchars($data["isiaduan"]);

  if ($file) {
    $filePath = '/opt/lampp/htdocs/pengaduan_masyarakat/assets/images/pengaduan/';

    $newFileName = time(); // Nama baru berdasarkan timestamp dan nama asli

    
    // Memeriksa tipe file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['file']['type'], $allowedTypes)) {
      
      return false;
    }
    
    // Mengatur jalur lengkap untuk file yang akan disimpan
    $targetFilePath = $filePath . $newFileName;
    // var_dump($_SESSION);
    // die;
    // Memindahkan file ke direktori tujuan
    
    if (move_uploaded_file($file['file']['tmp_name'], $targetFilePath)) {
      $query = "UPDATE `pengaduan` SET 
         tgl_pengaduan = '$tgl_pengaduan',
          nik ='$nik',
         isi_laporan = '$isiaduan',
          foto= '$newFileName'
          WHERE id_pengaduan = $id_pengaduan
  ";
    } else {

      return false;
    }
  } else {
    $query = "UPDATE `pengaduan` SET 
         tgl_pengaduan = '$tgl_pengaduan',
          nik ='$nik',
         isi_laporan = '$isiaduan'
 
          WHERE id_pengaduan = $id_pengaduan
  ";
  }



  mysqli_query($conn, $query);

  return true;
}
