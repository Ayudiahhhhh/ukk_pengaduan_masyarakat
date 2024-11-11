<?php include('../../layouts/header.php') ?>
<?php
include('../function/login.php');
    if (isset($_POST['username'])) {
        if(login($_POST['username'], $_POST['password']) == false){
            echo "<script>
                Swal.fire({
                title: 'error',
                text: 'Username atau Password Salah!',
                icon: 'error'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = '" . BASE_URL . "/auth/login';
                }
                });
        </script>";
        }        
    }
 
?>
<?php 
// var_dump($_SESSION);

// var_dump($_SESSION); die;
if (isset($_SESSION['user_type'])) {
    if($_SESSION['user_type'] == "masyarakat"){
        header("Location: ".BASE_URL."/masyarakat/dashboard");
    }else
    if($_SESSION['user_type'] == "petugas"){
        header("Location: ".BASE_URL."/petugas/dashboard");
    }else
    if($_SESSION['user_type'] == "admin"){
        header("Location:  ".BASE_URL."/admin/dashboard");
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
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../../layouts/footer.php') ?>