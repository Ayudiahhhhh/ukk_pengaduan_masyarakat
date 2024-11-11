<?php
include('./functions/crud_petugas.php');
$id = $_GET["id_petugas"];
if(hapus($id) > 0){
        echo"<script>
                Swal.fire({
                title: 'Success',
                text: 'Petugas berhasil ditambahkan!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/petugas';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Petugas gagal ditambahkan!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/petugas';
                }
                });
        </script>";
    }

?>