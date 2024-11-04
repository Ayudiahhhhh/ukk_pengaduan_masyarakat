<?php include('../../layouts/header.php') ?>
<?php
include('../function/register.php');
if (isset($_POST['nik'])) {
    if(register($_POST) == true){
        echo"<script>
        alert('user baru berhasil ditambahkan!');
         document.location.href = '" . BASE_URL . "/auth/login';
        </script>";   
    }else{
        echo"<script>
        alert('user baru gagal ditambahkan!');
        </script>";  
    }
    
}
 
// var_dump($_SESSION);
if (isset($_SESSION['user_type'])) {
    if($_SESSION['user_type'] == "masyarakat"){
        header("Location: ".BASE_URL."/masyarakat/dashboard");
    }else
    if($_SESSION['user_type'] == "petugas"){
        header("Location: ".BASE_URL."/petugas/dashboard");
    }
}

?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="<?= BASE_URL ?>/assets/images/logos/dark-logo.svg" width="180" alt="">
                            </a>
                            <p class="text-center">Your Social Campaigns</p>
                            <form action="" method="post">
                            <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">nik</label>
                                    <input type="text" class="form-control" name="nik" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan nik...">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">nama</label>
                                    <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan nama...">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan username...">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="masukan password...">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password2" id="exampleInputPassword1" placeholder="masukan password...">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label">telp</label>
                                    <input type="number" class="form-control" name="telp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan no hp...">
                                </div>
                             <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Register</button>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../../layouts/footer.php') ?>