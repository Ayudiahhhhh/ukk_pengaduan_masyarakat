<?php
include('./functions/crud_masyarakat.php');
$id = $_GET["nik"];

if (hapus($id) > 0) {
    echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil diHapus!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/pengaduan';
                }
                });
        </script>";
} else {
    echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Pengaduan gagal diHapus!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/pengaduan';
                }
                });
        </script>";
}
