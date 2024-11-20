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

function createTanggapan($post, $s)
{
  global $conn;
  $sql = "INSERT INTO `tanggapan`( `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES (
  '" . mysqli_real_escape_string($conn, $post['id_pengaduan']) . "',
    '" . mysqli_real_escape_string($conn, $post['tgl_tanggapan']) . "',
      '" . mysqli_real_escape_string($conn, $post['tanggapan_value']) . "',
            '" . mysqli_real_escape_string($conn, $s['user']['id_petugas']) . "')";

  if (mysqli_query($conn, $sql)) {
    $sql = "UPDATE `pengaduan` SET `status`= '" . mysqli_real_escape_string($conn, $post['status']) . "' WHERE `id_pengaduan`='" . mysqli_real_escape_string($conn, $post['id_pengaduan']) . "'";
    // var_dump($sql);
    // die;
    if (mysqli_query($conn, $sql)) {
      return true; // Berhasil
     } else {
      return false; // Gagal
    }
  } else {
    return false; // Gagal
  }
}
function changeStatus($get)
{
  // var_dump($get);
  // die;
  global $conn;
  $status = $get['status'];
  $id = $get['id'];
  
  $query = "UPDATE `pengaduan` SET `status`='$status' WHERE `id_pengaduan`='$id'";
  //  var_dump($query);
  //   die;
  mysqli_query($conn, $query);

  return true;
}


function tambah($post, $file)
{
  global $conn;

  $filePath = 'assets/images/pengaduan/';

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
  mysqli_query($conn, "DELETE FROM masyarakat WHERE nik=$id");

  return true;
}



function ubah($data, $nik)
{

  global $conn;
  $nik_new = $data["nik"];
  $nik = htmlspecialchars($data["nik"]);
  $nama = htmlspecialchars($data["nama"]);
  $username = htmlspecialchars($data["username"]);
  $telp = htmlspecialchars($data["telp"]);


  if ($nik != $data['nik']) {



    // Cek di tabel masyarakat
    // "b", "d", "i", "s
    $sql = "SELECT * FROM masyarakat WHERE username = ?";
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
