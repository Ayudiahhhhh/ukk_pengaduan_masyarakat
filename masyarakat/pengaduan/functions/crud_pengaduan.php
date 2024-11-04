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
    echo 'File uploaded successfully as ' . $newFileName;

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



function ubah($data, $nik)
{
// var_dump(masuk);
// die;
  global $conn;
  $id_pengaduan = htmlspecialchars($data["id_pengaduan"]);
  $tgl_pengaduan = htmlspecialchars($data["tgl_pengaduan"]);
  $nik = htmlspecialchars($data, $_SESSION["user"]["nik"]);
  $isiaduan = htmlspecialchars($data["isi_laporan"]);
  $foto = htmlspecialchars($data["foto"]);

  if ($id_pengaduan != $data['id_pengaduan']) {



    // Cek di tabel pengaduan
    // "b", "d", "i", "s
    $sql = "SELECT * FROM pengaduan WHERE id_pengaduan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $data['id_pengaduan']);
    $stmt->execute();
    $result = $stmt->get_result();
    // var_dump($result);
    // die;
    if ($result->num_rows > 0) {
      echo "<script> alert('id_pengaduan sudah terdaftar')</script>";
      return false;
    }

    $sql = "SELECT * FROM pengaduan WHERE id_pengaduan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $data['id_pengaduan']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      echo "<script> alert('data anda sudah terdaftar')</script>";
      return false;
    }
  }


  $query = "UPDATE `pengaduan` SET 
         tgl_pengaduan = '$tgl_pengaduan',
          nama =' $nik',
         isi_laporan = '$isiaduan',
          foto= '$foto'
          WHERE id_pengaduan = $id_pengaduan
  ";
  mysqli_query($conn, $query);

  return true;
}
