<!-- kengunaan function untuk menghapus dan menambah data di data base -->
<?php
$conn = mysqli_connect("localhost","root","","pengaduan_masyarakat");


function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows =[];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}



function tambah($data){

    global $conn;
    $id_pengaduan = htmlspecialchars($data["id_pengaduan"]);
    $status = htmlspecialchars($data["status"]);
    $tgl_pengaduan = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi_laporan = htmlspecialchars($data["isi_laporan"]);
    $foto = htmlspecialchars($data["foto"]);
    //upload gambar
    $foto = upload();
    if (!$foto){
        return false;
    }

     $query = "INSERT INTO `pengaduan`(`id_pengaduan`, `status`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`) VALUES
     VALUES
     ('$id_pengaduan','$status','$tgl_pengaduan','$nik','$isi_laporan','$foto') ";
    
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function upload() {

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    //cek apakah tidak ada foto yang diupoad
    if($error === 4){
        echo"<script>
        alert('pilih foto terlebih dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang  diupload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png',];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower (end($ekstensiGambar));
    if( !in_array ($ekstensiGambar, $ekstensiGambarValid)) {
    echo"<script>
    alert('yang anda upload bukan gambar!');
    </script>";
    return false;
}
 //jika ukurannya terlalu besar
 if( $ukuranFile > 1000000){
    echo"<script>
    alert('ukuran gambar terlalu besar!');
    </script>";
    return false;
 }

 //lolos pengecekan, gambar siap 
 //generate nama gambar baru
 $namaFiLeBaru = uniqid();
 $namaFiLeBaru .= '.';
 $namaFiLeBaru .= $ekstensiGambar;
 

 move_uploaded_file($tmpName, 'img/'.$namaFiLeBaru);

 return $namaFiLeBaru;

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    
    return mysqli_affected_rows($conn);

}


function  ubah($data){
    global $conn;
    
    $id = $data["id_pengaduan"];
    $id_pengaduan = htmlspecialchars($data["id_pengaduan"]);
    $status = htmlspecialchars($data["status"]);
    $tgl_pengaduan = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi_laporan = htmlspecialchars($data["isi_laporan"]);
    $foto = htmlspecialchars($data["foto"]);
    $fotoLama = htmlspecialchars($data["fotoLama"]);

     //cek apakah user pilih gambar baru atau tidak
     if( $_FILES['gambar']['error'] === 4){
        $foto = $fotoLama;
    }else{
        $foto = upload();

    }

    $query = "UPDATE `pengaduan` SET 
            id_pengaduan = '$id_pengaduan ',
            status =' $status',
            tgl_pengaduan = '$tgl_pengaduan',
            nik = '$nik',
            isi_laporan = '$isi_laporan'
            foto= '$foto'
            WHERE id = $id
    ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

// function cari($keyword){
//     $query ="SELECT * FROM mahasiswa
//                 WHERE 
//                 nama LIKE '%$keyword%'OR
//                 nisn LIKE '%$keyword%'OR
//                 email LIKE '%$keyword%'OR
//                 jurusan LIKE '%$keyword%'

//     ";
//     return query($query);
// }


// function registrasi($data){
//     global $conn;

//     $username = strtolower(stripslashes($data["username"]));
//     $password = mysqli_real_escape_string($conn, $data ["password"]);
//     $password2 = mysqli_real_escape_string($conn, $data ["password2"]);

//     //cek username sudah ada atau belum
//     $result = mysqli_query($conn, "SELECT * FROM user
//      WHERE username = '$username'" );
     

//     if( mysqli_fetch_assoc($result) ){
//         echo"<script>
//         alert('username terdaftar');
//         </script>";
//         return false;
//     }

//     //cek konfirmasi password
//     if($password !== $password2) {
//         echo"<script>
//         alert('konfirmasi password tidak sesuai');
//         </script>";

//     return false;   
//     }
  
//     //enskripsi password 
//     $password = password_hash($password, PASSWORD_DEFAULT);


//     //tambahkan user baru ke database
//     mysqli_query($conn,"INSERT INTO user  VALUES ('','$username','$password')");


//     return mysqli_affected_rows($conn);

// }
?>
