<?php
include('./functions/crud_petugas.php');
$id = $_GET["id_petugas"];
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