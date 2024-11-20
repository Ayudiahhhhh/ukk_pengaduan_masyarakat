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



function tambah($post, $file)
{
  global $conn;

  $filePath = '../../../assets/images/pengaduan/';

  // Memeriksa apakah file diupload dengan benar
if (isset($file) && $file['error'] == 0) 
  // Nama baru berdasarkan timestamp
  $newFileName = time(); 



  // Memeriksa tipe file
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($file['type'], $allowedTypes)) {

     // Mengambil ekstensi file asli
     $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
     // Menambahkan ekstensi file pada nama baru
     $targetFilePath = $filePath . $newFileName . '.' . $extension;
    return false;
  }

  // Mengatur jalur lengkap untuk file yang akan disimpan
  $targetFilePath = $filePath . $newFileName;
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
    $filePath = '/lampp/htdocs/pengaduan_masyarakat/assets/images/pengaduan/';

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


function ubahprofile($data, $nik){
  
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
?>
