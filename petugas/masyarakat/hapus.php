<?php
include('./functions/crud_masyarakat.php');
$id = $_GET["nik"];

if(hapus($id) > 0){
        echo"
        <script>
        alert( 'data berhasil di hapus!');
        document.location.href ='index.php';
        </script>
        ";
    }else{
        echo"
        <script>
        alert( 'data gagal di tambahkan!');
        document.location.href ='index.php';
        </script>
         ";
    }
?>