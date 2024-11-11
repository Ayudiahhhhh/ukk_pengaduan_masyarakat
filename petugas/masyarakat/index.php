<?php
session_start();
include('../../database/koneksi.php');
include('../../layouts/header.php');
include('./functions/crud_masyarakat.php');
if (isset($_GET["nik"])) {
    $id = $_GET["nik"];
    if(hapus($id) > 0){
            echo"<script>
                    Swal.fire({
                    title: 'Success',
                    text: 'Masyarakat berhasil dihapus!',
                    icon: 'success'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = '" . BASE_URL . "/petugas/masyarakat';
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
                        document.location.href = '" . BASE_URL . "/petugas/masyarakat';
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
                text: 'Masyarakat berhasil ditambahkan!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/masyarakat';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Masyarakat gagal ditambahkan!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/masyarakat';
                }
                });
        </script>";
    }
}

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['ubahmasyarakat'])) {

   //cek apakah data berhasil diubah atau tidak
   if(ubah($_POST, $_POST['nik'])== true) {
    echo "<script>
                Swal.fire({
                title: 'Success',
                text: 'Masyarakat berhasil diubah!',
                icon: 'success'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/masyarakat';
                }
                });
        </script>";
    } else {
        echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Masyarakat gagal diubah!',
                icon: 'info'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/petugas/masyarakat';
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
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h3>Data Masyarakat</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <i class="ti ti-plus">Tambah Data Masyarakat</i>
                        </button>
                    </div>
                    <!-- Modal Tambah -->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Masyarakat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">NIK</label>
                                            <input type="text" class="form-control" id="nama" name="nik" required placeholder="masukan nik....">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <div class="text-center"></div>
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" required placeholder="masukan nama....">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <div class="text-center"></div>
                                                    <label for="nama" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="nama" name="username" required placeholder="masukan username....">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">No. Hp</label>
                                            <input type="text" class="form-control" id="nama" name="telp" required placeholder="masukan No.hp">
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

                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">No.hp</th>
                            <th scope="col">Aksi</th>

                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (get("SELECT * FROM masyarakat") as $no => $d) :
                            ?>
                                <tr>
                                    <td><?php echo $no + 1; ?></td>
                                    <td><?php echo $d['nik']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['username']; ?></td>
                                    <td><?php echo $d['telp']; ?></td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $d['nik']; ?>"><i class="ti ti-pencil"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $d['nik']; ?>"><i class="ti ti-trash"></i></a>
                                    </td>

                                </tr>

                              <!-- Modal Ubah -->
                                <div class="modal fade" id="modalUbah<?= $d['nik']; ?>" tabindex="-1" aria-labelledby="modalUbahLabel<?= $d['nik']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalUbah<?= $d['nik']; ?>">Ubah Data Masyrakat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="username_lama" value="<?= $d['username']; ?>">
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">NIK</label>
                                                        <input type="text" class="form-control" id="nama" name="nik" value="<?= $d['nik']; ?>"required placeholder="masukan nik....">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <div class="text-center"></div>
                                                                <label for="nama" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama']; ?>"required placeholder="masukan nama....">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <div class="text-center"></div>
                                                                <label for="nama" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="nama" name="username" value="<?= $d['username']; ?>"required placeholder="masukan username....">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">No. Hp</label>
                                                        <input type="text" class="form-control" id="nama" name="telp" value="<?= $d['telp']; ?>"required placeholder="masukan No.hp">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="ubahmasyarakat" value="1">Ubah</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
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
                                                <p>Apakah Anda yakin ingin menghapus Data ini?</p>
                                                <input type="hidden" value="<?= $d['nik']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="?nik=<?= $d['nik']; ?>" class="btn btn-danger">Hapus</a>
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

<?php
include('../../layouts/footer.php');
?>