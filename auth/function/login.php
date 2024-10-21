<?php
include('../../database/koneksi.php');

function login($username, $password) {
    global $conn;

    // Cek di tabel masyarakat
    // "b", "d", "i", "s
    $sql = "SELECT * FROM masyarakat WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
       
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_type'] = 'masyarakat';
            $_SESSION['user'] = $user;
            header("Location: ". BASE_URL."/masyarakat/dashboard");
            exit();
        }
    }

    // Cek di tabel petugas
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $users['password'])) {
            $_SESSION['user'] = $users;
           
            if($users['level'] == 'admin'){
                $_SESSION['user_type'] = 'admin';
                header("Location: ". BASE_URL."/admin/dashboard");
            }else if($users['level'] == 'petugas'){
                $_SESSION['user_type'] = 'petugas';
                
                header("Location: ". BASE_URL."/petugas/dashboard");

            }
            exit();
        }
    }
   

    // Jika tidak ditemukan
    return false;
}
