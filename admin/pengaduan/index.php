<?php
session_start();
include('../../database/koneksi.php');
include('../../layouts/header.php');
include('./functions/crud_pengaduan.php');

if (isset($_POST['proses'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST, $_FILES['foto']) == true) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = '" . BASE_URL . "/masyarakat/pengaduan';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
        </script>";
    }
}
if (isset($_GET['id'])) {
    if (changeStatus($_GET) == true) {
        echo "<script>
            alert('Data berhasil " . $_GET['status'] . "!');
            document.location.href = '" . BASE_URL . "/admin/pengaduan';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal " . $_GET['status'] . "!');
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
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
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
                                            echo "<p class='text-warning'>Diajukan</p>";
                                        } elseif ($d['status'] == 'proses') {
                                            echo "<p class='text-info'>Sedang diproses</p>";
                                        } elseif ($d['status'] == 'selesai') {
                                            echo "<p class='text-success'>Pengaduan selesai</p>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLihat<?= $d['id_pengaduan']; ?>"><i class="ti ti-eye-check"></i></a>
                                    </td>
                                </tr>

                                <!-- Modal Lihat -->
                                <div class="modal fade" id="modalLihat<?= $d['id_pengaduan']; ?>" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTambahLabel">Lihat Data Aduan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="tgl_petugas" class="form-label">Tgl Pengaduan</label>
                                                    <input type="date" class="form-control" id="tgl_petugas" name="tgl_petugas" value="<?= $d['tgl_pengaduan']; ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Pengaduan</label>
                                                    <input type="text" class="form-control" id="username" name="username" value="<?= $d['nama']; ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="isi_laporan" class="form-label">Isi Aduan</label>
                                                    <input type="text" class="form-control" id="isi_laporan" name="isi_laporan" value="<?= $d['isi_laporan']; ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="foto" class="form-label">Foto</label>
                                                    <img src="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" alt="Foto Aduan" width="100%">
                                                    <a href="<?= BASE_URL ?>/assets/images/pengaduan/<?= $d['foto']; ?>" download="" class="btn btn-primary btn-sm mt-3">Download File</a>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <?php
                                                if ($d['status'] == 0) { ?>
                                                    <a class="btn btn-warning" href="?id=<?= $d['id_pengaduan'] ?>&status=proses">Proses</a>
                                                <?php } elseif ($d['status'] == 'proses') { ?>
                                                    <a class="btn btn-primary" href="?id=<?= $d['id_pengaduan'] ?>&status=selesai">Selesai</a>
                                                <?php  }
                                                ?>
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
                                                <a href="hapus.php?nik=<?= $d['nik']; ?>" class="btn btn-danger">Hapus</a>
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