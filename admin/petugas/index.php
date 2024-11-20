<?php

include('../../database/koneksi.php');
include('../../layouts/header.php');
include('./functions/crud_petugas.php');
if (isset($_GET["id_petugas"])) {
    $id = $_GET["id_petugas"];
    if (hapus($id) == true) {
        echo "<script>
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
}
if (isset($_POST['bsimpan'])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) == true) {
        echo "<script>
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
}


if (isset($_POST['ubahadmin'])) {
    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST, $_POST['id_petugas']) == true) {
        echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Petugas berhasil diubah!',
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
                text: 'Petugas gagal diubah!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/admin/petugas';
                }
                });
        </script>";
    }
}

?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php
    include('../layouts/aside.php');
    ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <?php
        include('../layouts/nav.php');
        ?>
        <!--  Header End -->
        <div class="container-fluid">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex align-items-start row col-12">
                        <div class="row">
                            <div class="col-2">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-admin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-admin" type="button" role="tab" aria-controls="v-pills-admin" aria-selected="true">Admin</button>
                                    <button class="nav-link" id="v-pills-petugas-tab" data-bs-toggle="pill" data-bs-target="#v-pills-petugas" type="button" role="tab" aria-controls="v-pills-petugas" aria-selected="false">Petugas</button>

                                </div>
                            </div>
                            <div class="col-10">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-admin" role="tabpanel" aria-labelledby="v-pills-admin-tab">
                                        <div class="text-center">
                                            <h3>Data Admin</h3>
                                        </div>
                                        <div class="text-end">
                                            <!-- Tombol Export -->
                                            <button class="btn btn-success btn-sm mb-2" type="button" onclick="exportTableToExcel('myTable', 'data_pengaduan')"><img width="20" height="20" src="https://img.icons8.com/fluency/48/ms-excel.png" alt="ms-excel"/>Export ke Excel</button>
                                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                                <i class="ti ti-plus">Tambah Data Petugas</i>
                                            </button>
                                        </div>
                                        <hr />
                                        <!-- Modal Tambah -->
                                        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTambahLabel">Tambah Data Petugas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_petugas" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" required placeholder="masukan nama...">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" required placeholder="masukan username....">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="telp" class="form-label">No.HP</label>
                                                                <input type="number" class="form-control" id="telp" name="telp" required placeholder="masukan no hp....">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="level" class="form-label">level</label>
                                                                <input type="text" class="form-control" id="level" name="level" value="admin" readonly>
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
                                        <table class="table table-striped table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">No.hp</th>
                                                    <th scope="col">Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach (get("SELECT * FROM `users` WHERE `level` = 'admin'") as $no => $d) :
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no + 1; ?></td>
                                                        <td><?php echo $d['nama_petugas']; ?></td>
                                                        <td><?php echo $d['username']; ?></td>
                                                        <td><?php echo $d['telp']; ?></td>
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbah<?php echo $d['id_petugas']; ?>"><i class="ti ti-pencil"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $d['id_petugas']; ?>"><i class="ti ti-trash"></i></a>

                                                        </td>

                                                    </tr>
                                                    <!--Modal Ubah-->
                                                    <div class="modal fade" id="modalUbah<?= $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $d['nik']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalUbah<?= $d['id_petugas']; ?>">Ubah Data Petugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_petugas" value="<?= $d['id_petugas']; ?>">
                                                                        <input type="hidden" name="username_lama" value="<?= $d['username']; ?>">
                                                                        <div class="mb-3">
                                                                            <label for="nama_petugas" class="form-label">Nama</label>
                                                                            <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?= $d['nama_petugas']; ?>" required placeholder="masukan username....">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="username" class="form-label">Username</label>
                                                                            <input type="text" class="form-control" id="username" name="username" value="<?= $d['username']; ?>" required placeholder="masukan username....">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="telp" class="form-label">No.HP</label>
                                                                            <input type="number" class="form-control" id="telp" name="telp" value="<?= $d['telp']; ?>" required placeholder="masukan username....">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="level" class="form-label">level</label>
                                                                            <input type="text" class="form-control" id="level" name="level" value="admin" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" name="ubahadmin" value="1">Ubah</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modalHapus<?= $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="modalHapus<?= $d['nik']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalHapusLabel<?= $d['id_petugas']; ?>">Hapus Data Petugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus Data Petugas ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="?id_petugas=<?= $d['id_petugas']; ?>" class="btn btn-danger">Hapus</a>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade " id="v-pills-petugas" role="tabpanel" aria-labelledby="v-pills-petugas-tab">
                                        <div class="text-center">
                                            <h3>Data petugas</h3>
                                        </div>
                                        <div class="text-end">
                                            <!-- Tombol Export -->
                                            <button class="btn btn-success btn-sm mb-2" type="button" onclick="exportTableToExcel('myTable', 'data_pengaduan')"><img width="20" height="20" src="https://img.icons8.com/fluency/48/ms-excel.png" alt="ms-excel"/>Export ke Excel</button>
                                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah1">
                                                <i class="ti ti-plus">Tambah Data Petugas</i>
                                            </button>
                                        </div>

                                        <hr />
                                        <!-- Modal Tambah -->
                                        <div class="modal fade" id="modalTambah1" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTambahLabel">Tambah Data Petugas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_petugas" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" required placeholder="masukan nama...">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" required placeholder="masukan username....">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="telp" class="form-label">No.HP</label>
                                                                <input type="number" class="form-control" id="telp" name="telp" required placeholder="masukan no hp....">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="level" class="form-label">level</label>
                                                                <input type="text" class="form-control" id="level" name="level" value="petugas" readonly>
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

                                        <table class="table table-striped table-hover" id="myTable1">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">No.hp</th>
                                                    <th scope="col">Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach (get("SELECT * FROM `users` WHERE `level` = 'petugas'") as $no => $d) :
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no + 1; ?></td>
                                                        <td><?php echo $d['nama_petugas']; ?></td>
                                                        <td><?php echo $d['username']; ?></td>
                                                        <td><?php echo $d['telp']; ?></td>
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbah<?php echo $d['id_petugas']; ?>"><i class="ti ti-pencil"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $d['id_petugas']; ?>"><i class="ti ti-trash"></i></a>

                                                        </td>

                                                    </tr>
                                                    <!--Modal Ubah-->
                                                    <div class="modal fade" id="modalUbah<?= $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $d['nik']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalUbah<?= $d['id_petugas']; ?>">Ubah Data Petugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_petugas" value="<?= $d['id_petugas']; ?>">
                                                                        <input type="hidden" name="username_lama" value="<?= $d['username']; ?>">
                                                                        <div class="mb-3">
                                                                            <label for="nama_petugas" class="form-label">Nama</label>
                                                                            <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?= $d['nama_petugas']; ?>" required placeholder="masukan username....">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="username" class="form-label">Username</label>
                                                                            <input type="text" class="form-control" id="username" name="username" value="<?= $d['username']; ?>" required placeholder="masukan username....">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="telp" class="form-label">No.HP</label>
                                                                            <input type="number" class="form-control" id="telp" name="telp" value="<?= $d['telp']; ?>" required placeholder="masukan username....">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="level" class="form-label">level</label>
                                                                            <input type="text" class="form-control" id="level" name="level" value="admin" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" name="ubahadmin" value="1">Ubah</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modalHapus<?= $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="modalHapus<?= $d['nik']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalHapusLabel<?= $d['id_petugas']; ?>">Hapus Data Petugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus Data Petugas ini?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="?id_petugas=<?= $d['id_petugas']; ?>" class="btn btn-danger">Hapus</a>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
include('../../layouts/footer.php');
?>