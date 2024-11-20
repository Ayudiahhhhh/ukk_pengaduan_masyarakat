<?php

include('../../database/koneksi.php');
include('../../layouts/header.php');
include('./functions/crud_pengaduan.php');
if (isset($_GET["id_pengaduan"])) {
    $id = $_GET["id_pengaduan"];
    if (hapus($id)  == true) {
        echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil dihapus!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "petugas/pengaduan';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Pengaduan gagal dihapus!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "petugas/pengaduan';
                }
                });
        </script>";
    }
}
if (isset($_POST['tanggapan'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (createTanggapan($_POST) == true) {
        echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil ditambahkan!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/pengaduan';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Pengaduan gagal ditambahkan!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/pengaduan';
                }
                });
        </script>";
    }
    if (isset($_POST['proses'])) {
        // cek apakah data berhasil ditambahkan atau tidak
        if (tambah($_POST, $_FILES['foto']) == true) {
            echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil ditambahkan!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/pengaduan';
                }
                });
        </script>";
        } else {
            echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Pengaduan gagal ditambahkan!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/pengaduan';
                }
                });
        </script>";
        }
    }
    if (isset($_GET['id'])) {
        if (changeStatus($_GET) == true) {
            echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil ditambahkan!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/pengaduan';
                }
                });
        </script>";
        } else {
            echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Pengaduan gagal ditambahkan!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/pengaduan';
                }
                });
        </script>";
        }
    }
}

?>
<style>
    @keyframes flash {
        0% {
            background-color: #ffcc00;
            /* Warna saat menyala */
        }

        50% {
            background-color: #ffffff;
            /* Warna saat mati (putih) */
        }

        100% {
            background-color: #ffcc00;
            /* Kembali menyala */
        }
    }

    .flash-background {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        color: #fff;
        font-size: 10px;
        font-weight: bold;
        text-align: center;
        background-color: #ffcc00;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        animation: flash 1s infinite;
    }
</style>
<!-- Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include('../layouts/aside.php'); ?>
    <!-- Sidebar End -->

    <!-- Main wrapper -->
    <div class="body-wrapper">
        <!-- Header Start -->
        <?php include('../layouts/nav.php'); ?>
        <!-- Header End -->

        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h3>Data Pengaduan</h3>
                    </div>
                    <!-- Tombol Export -->
                    <div class="text-end">
                        <button class="btn btn-success btn-sm" type="button" onclick="exportTableToExcel('myTable', 'data_pengaduan')"><img width="20" height="20" src="https://img.icons8.com/fluency/48/ms-excel.png" alt="ms-excel" />Export ke Excel</button>
                    </div>
                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tgl_Pengaduan</th>
                                <th scope="col">Pengadu</th>
                                <th scope="col">Isi Aduan</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (get("SELECT pengaduan.*, masyarakat.nama FROM pengaduan JOIN masyarakat ON masyarakat.nik = pengaduan.nik") as $no => $d): ?>
                                <tr>
                                    <td><?= $no + 1; ?></td>
                                    <td><?= $d['tgl_pengaduan']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['isi_laporan']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $d['id_pengaduan']; ?>">
                                            Lihat
                                        </button>

                                    </td>
                                    <td>
                                        <?php
                                        if ($d['status'] == 0) {
                                            echo "<p class='text-dark text-center flash-background'>Diajukan</p>";
                                        } elseif ($d['status'] == 'proses') {
                                            echo "<p class='text-info'>Sedang diproses</p>";
                                        } elseif ($d['status'] == 'selesai') {
                                            echo "<p class='text-success'>Pengaduan selesai</p>";
                                        } elseif ($d['status'] == 'ditolak') {
                                            echo "<p class='text-danger'>Pengaduan ditolak</p>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLihat<?= $d['id_pengaduan']; ?>"><i class="ti ti-eye-check"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $id = $d['id_pengaduan'];
                                $tg = get("SELECT * FROM `tanggapan` WHERE id_pengaduan=$id");
                                //    var_dump($tg);
                                //    die;     
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $d['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lihat Data Aduan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <div class="mb-3">
                                                        <label for="foto" class="form-label">Foto</label>
                                                        <br>
                                                        <img src="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" alt="Foto Aduan" width="100%">
                                                        <br>
                                                        <a href="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" download="" class="btn btn-primary btn-sm mt-3">Download File</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Lihat -->
                                <div class="modal fade" id="modalLihat<?= $d['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTambahLabel">Lihat Data Aduan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_pengaduan" value="<?= $d['id_pengaduan']; ?>">
                                                <input type="hidden" name="id_petugas" value="<?= $_SESSION['user']['id_petugas']; ?>">
                                                <input type="hidden" name="tgl_tanggapan" value="<?= date('Y-m-d') ?>">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_pengaduan" class="form-label">Tgl Pengaduan</label>
                                                                <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan" value="<?= $d['tgl_pengaduan']; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Pengadu</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?= $d['nama']; ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="isi_laporan" class="form-label">Isi Aduan</label>
                                                                <input type="text" class="form-control" id="isi_laporan" name="isi_laporan" value="<?= $d['isi_laporan']; ?>" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="foto" class="form-label">Foto</label>
                                                                <br>
                                                                <img src="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" alt="Foto Aduan" width="60%">
                                                                <br>
                                                                <a href="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" download="" class="btn btn-primary btn-sm mt-3">Download File</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tanggapan" class="form-label">Tanggapan</label>
                                                                <textarea class="form-control" name="tanggapan_value" id="tanggapan" rows="13" required><?= isset($tg[0]['tanggapan']) ? $tg[0]['tanggapan'] : ""  ?></textarea>
                                                            </div>
                                                            <select class="form-select" name="status" aria-label="Default select example">
                                                                <option value="proses">setuju</option>
                                                                <option value="ditolak">tolak</option>
                                                        </div>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php
                                                        if ($d['status'] == 0) {
                                                        ?>
                                                            <button class="btn btn-primary btn-sm" name="tanggapan" type="submit" value="1">simpan</button>
                                                        <?php
                                                        } elseif ($d['status'] == 'proses') { ?>
                                                            <a href="?id=<?= $d['id_pengaduan'] ?>&status=selesai" class="btn btn-primary btn-sm" onclick="return confirm('selesaikan aduan?')">Selesaikan</a>
                                                        <?php } ?>

                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>


            <!-- Modal Hapus -->
            <div class="modal fade" id="modalHapus<?= $d['nik']; ?>" tabindex="-1" aria-labelledby="modalHapus<?= $d['nik']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusLabel<?= $d['nik']; ?>">Hapus Aduan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus aduan ini?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="?nik=<?= $d['nik']; ?>" class="btn btn-danger">Hapus</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </tbody>
        </table>
        </div>
    </div>
</div>


<?php
include('../../layouts/footer.php');
?>