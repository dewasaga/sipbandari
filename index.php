<?php
session_start();
include 'koneksi.php';

// Pastikan halaman tidak di-cache
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Variabel untuk menyimpan pesan alert
$alert = '';

// Periksa jika pengguna sudah login, redirect ke halaman yang sesuai
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'warga') {
        header("Location: beranda.php");
    } elseif ($_SESSION['role'] == 'rt') {
        header("Location: rt.php");
    } elseif ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role, is_confirmed FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $stored_password, $role, $is_confirmed);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Verifikasi password menggunakan password_verify() jika password sudah di-hash
        if (password_verify($password, $stored_password)) {
            // Pengecekan status konfirmasi
            if ($is_confirmed != 1) {
                $alert = '<div class="alert alert-warning" role="alert">Akun Anda belum dikonfirmasi oleh admin.</div>';
            } else {
                // Set session
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirect sesuai role
                if ($role == 'warga') {
                    header("Location: beranda.php");
                } elseif ($role == 'rt') {
                    header("Location: rt.php");
                } elseif ($role == 'admin') {
                    header("Location: admin.php");
                }
                exit();
            }
        } else {
            $alert = '<div class="alert alert-danger" role="alert">Password salah.</div>';
        }
    } else {
        $alert = '<div class="alert alert-danger" role="alert">Pengguna tidak ditemukan.</div>';
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <div class="container-login">
        <div class="left_login">
            <img src="images/logo.png" alt="logo" class="logo_login">
            <h3>SELAMAT</h3>
            <h3>DATANG</h3>
            <p>WEBSITE SIP <br> SISTEM INFORMASI PENDUDUK <br> RT 01 DUSUN BANDARI</p>
        </div>
        <div class="right_login">
        <h2 class="text-center">Login</h2>
                <?php echo $alert; ?> <!-- Tampilkan alert di sini -->
                <form action="index.php" method="POST">
                    <div class="form-input">
                        <label for="username">No. KK/Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-input">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                
                
                <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
     
    </div>
</body>
</html>
