<?php
include('./functions/crud_masyarakat.php');
$id = $_GET["nik"];

if(hapus($id) > 0){
        echo"
        <script>
                Swal.fire({
                title: 'Success',
                text: 'Masyarakat berhasil dihapus!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/masyarakat';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Masyarakat gagal dihapus!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/masyarakat';
                }
                });
        </script>";
}
?>