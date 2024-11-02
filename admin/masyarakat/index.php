<?php include('../../layouts/header.php') ?>
<?php
include('functions/crud_masyarakat.php');

//  var_dump(get("SELECT * FROM masyarakat"));
//  die;

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
                        <a href="<?= BASE_URL ?>/admin/masyarakat/tambah.php" class="btn btn-primary text-white btn-sm mb-3"><i class="ti ti-plus">tambah data masyarakat</i></a>
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
                                    <td><?php echo $no+1; ?></td>
                                    <td><?php echo $d['nik']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['username']; ?></td>
                                    <td><?php echo $d['telp']; ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>/petugas/masyarakat/ubah.php?nik=<?= $d['nik']; ?>"><i class="ti ti-pencil"></i></a>
                                        <a href="<?= BASE_URL ?>/petugas/masyarakat/hapus.php?nik=<?= $d['nik']; ?>"><i class="ti ti-trash"></i></a>
                                        <!-- <i class="ti ti-trash-x"></i> -->



                                    </td>

                                </tr>
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