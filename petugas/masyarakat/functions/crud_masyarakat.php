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



function ubah($data, $nik_lama) {
    global $conn;

    // Ambil data baru dari $data
    $nik_baru = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $username_lama = htmlspecialchars($data["username_lama"]);
    $telp = htmlspecialchars($data["telp"]);

    // Cek apakah username diubah dan validasi jika sudah terdaftar
    if ($username != $username_lama) {
        $sql = "SELECT * FROM masyarakat WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $data['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Username sudah terdaftar');</script>";
            return false;
        }
    }

    // Cek apakah NIK diubah dan validasi jika sudah terdaftar
    if ($nik_baru != $nik_lama) {
        $sql = "SELECT * FROM masyarakat WHERE nik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nik_baru);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Data dengan NIK tersebut sudah terdaftar');</script>";
            return false;
        }
    }

    // Update data masyarakat
    $query = $query = "UPDATE masyarakat SET 
    nik = ?, 
    nama = ?, 
    username = ?, 
    telp = ? 
  WHERE nik = ?";

// Masukkan semua 5 nilai ke dalam bind_param
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $nik_baru, $nama, $username, $telp, $nik_lama);

// Eksekusi query
if ($stmt->execute()) {
echo "<script>alert('Data berhasil diubah');</script>";
} else {
var_dump($stmt->error); // Debug jika ada error
}
$stmt = $conn->prepare($query);

    // Pastikan bind_param sesuai urutan
    $stmt->bind_param("sssss", $nik_baru, $nama, $username, $telp, $nik_lama);

    // Jalankan query dan cek hasil
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diubah');</script>";
        return true;
    } else {
        var_dump($stmt->error); // Debug query error
        echo "<script>alert('Gagal memperbarui data');</script>";
        return false;
    }
}







