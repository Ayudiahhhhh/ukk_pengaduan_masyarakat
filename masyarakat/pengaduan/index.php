<?php

include('../../database/koneksi.php');
include('../../layouts/header.php');
include('./functions/crud_pengaduan.php');
if ($_GET["id_pengaduan"]) {
    $id = $_GET["id_pengaduan"];
if(hapus($id)  == true){
        echo"<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil dihapus!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
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
                    document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
                }
                });
        </script>";
    }
}

if (isset($_POST['bsimpan'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST, $_FILES['foto']) == true) {
        echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil ditambahkan!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
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
                    document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
                }
                });
        </script>";
    }
}
if (isset($_POST['ubahaduan'])) {
    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST, $_FILES) == true) {
        echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Pengaduan berhasil diubah!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Pengaduan gagal diubah!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
                }
                });
        </script>";
    }
}

?>

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
                            <div class="text-center">
                                <h3>Data Pengaduan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <i class="ti ti-plus">Tambah Aduan</i>
                            </button>
                        </div>


                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahLabel">Tambah Aduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="pengadu" class="form-label text-start">Pengadu</label>
                                                <input type="text" class="form-control" name="pengadu" id="pengadu" readonly value="<?= $_SESSION['user']['nama'] ?>" placeholder="g usah di isi sesuain sama yg login">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tglPengaduan" class="form-label text-start">Tgl Pengaduan</label>
                                                <input type="date" class="form-control" name="tgl_pengaduan" id="tglPengaduan" readonly value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="isiaduan" class="form-label">Isi Aduan</label>
                                                <textarea class="form-control" name="isiaduan" id="isiaduan" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto" class="form-label text-start">Foto</label>
                                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="bsimpan" value="1">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                                        <td><img src="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" alt="Foto Aduan" width="100"></td>
                                        <td>
                                            <?php
                                            if ($d['status'] == 0) {
                                                echo "<p class='text-warning'>Berhasil diajukan</p>";
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
                                            <?php
                                            if ($d['status'] == 0) {
                                            ?>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $d['id_pengaduan']; ?>"><i class="ti ti-pencil"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $d['id_pengaduan']; ?>"><i class="ti ti-trash"></i></a>
                                            <?php } else { ?>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modaltanggapan<?= $d['id_pengaduan']; ?>"><button type="button" class="btn btn-primary btn-sm">Lihat tanggapan</button></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $id = $d['id_pengaduan'];
                                    $tg = get("SELECT * FROM `tanggapan` WHERE id_pengaduan=$id")[0];
                                    //    var_dump($tg);
                                    //    die;     
                                    ?>
                                    <!-- Modal tanggapan -->
                                    <div class="modal fade" id="modaltanggapan<?= $d['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTambahLabel">Lihat Tanggapan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="tgl_tanggapan" class="form-label">Tgl tanggapan</label>
                                                            <input type="date" class="form-control" id="tgl_tanggapan" name="tgl_tanggapan" value="<?= $tg['tgl_tanggapan'] ?>" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggapan" class="form-label">Tanggapan Petugas</label>
                                                            <textarea class="form-control" name="tanggapan_value" id="tanggapan" rows="13" readonly><?= $tg['tanggapan'] ?></textarea>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                    </div>

                    <!-- Modal Ubah -->
                    <div class="modal fade" id="modalUbah<?= $d['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $d['id_pengaduan']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalUbah<?= $d['id_pengaduan']; ?>">Ubah Aduan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_pengaduan" value="<?= $d['id_pengaduan']; ?>">
                                        <div class="mb-3">
                                            <label for="pengadu" class="form-label text-start">Pengadu</label>
                                            <input type="text" class="form-control" name="pengadu" id="pengadu" readonly value="<?= $_SESSION['user']['nama'] ?>" placeholder="g usah di isi sesuain sama yg login">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tglPengaduan" class="form-label text-start">Tgl Pengaduan</label>
                                            <input type="date" class="form-control" name="tgl_pengaduan" id="tglPengaduan" readonly value="<?= date('Y-m-d') ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="isiaduan" class="form-label">Isi Aduan</label>
                                            <textarea class="form-control" name="isiaduan" id="isiaduan" rows="3" required><?= $d['isi_laporan']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="file" id="foto" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="ubahaduan" value="1">Simpan Perubahan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $d['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="modalHapus<?= $d['id_pengaduan']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHapusLabel<?= $d['id_pengaduan']; ?>">Hapus Aduan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus aduan ini?</p>
                                    <input type="hidden" value="<?= $d['id_pengaduan']; ?>">
                                </div>
                                <div class="modal-footer">
                                    <a href="?id_pengaduan=<?= $d['id_pengaduan']; ?>" class="btn btn-danger">Hapus</a>
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