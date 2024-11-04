<?php
include('./functions/crud_masyarakat.php');

$d= get("SELECT * FROM masyarakat WHERE nik=".$_GET['nik'])[0];
// var_dump($val);
// die;

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['nik'])) {

   //cek apakah data berhasil diubah atau tidak
   if(ubah($_POST, $_GET['nik'])== true) {
    echo "<script>
    alert('data berhasil diubah !');
    window.location.href = '".BASE_URL."/petugas/masyarakat';
  </script>";

    }else{
        echo"<script>
        alert('data gagal diubah !');
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
                                <h3>Ubah Data Masyarakat</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="container-fluid">
                            <div class="mb-3">
                                <label for="nama" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nama" name="nik" value="<?=$d["nik"]; ?>" required placeholder="masukan nik....">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <div class="text-center"></div>
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?=$d["nama"]; ?>" required placeholder="masukan nama....">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <div class="text-center"></div>
                                        <label for="nama" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="nama" name="username" value="<?=$d["username"]; ?>" required placeholder="masukan username....">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">No. Hp</label>
                                <input type="text" class="form-control" id="nama" name="telp" value="<?=$d["telp"]; ?>" required placeholder="masukan No.hp">
                            </div>
                        </div>
                        <div class="text-end"><button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>



                </div>
            </div>



        </div>
    </div>
</div>

<?php
include('../../layouts/footer.php');
?>