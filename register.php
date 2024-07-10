<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_kk = $_POST['no_kk'];
    $nomor_hp = $_POST['nomor_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_password = $_POST['verify_password'];

    // Validasi sederhana
    if ($password !== $verify_password) {
        echo "Password tidak cocok.";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Mulai transaksi
        $conn->begin_transaction();

        try {
            // Masukkan ke tabel user
            $stmt = $conn->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, 'warga')");
            $stmt->bind_param("ss", $no_kk, $hashed_password);
            $stmt->execute();
            $user_id = $stmt->insert_id; // Dapatkan ID pengguna yang baru saja dimasukkan

            // Masukkan ke tabel profile
            $stmt = $conn->prepare("INSERT INTO profile (user_id, nama, no_kk, nomor_hp, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $user_id, $nama, $no_kk, $nomor_hp, $email);
            $stmt->execute();
    


            // Commit transaksi
            $conn->commit();
            echo "Registrasi berhasil! Akun Anda akan dikonfirmasi oleh admin.";
            header("Location: admin.php"); // Ganti dengan halaman admin yang sesuai
            exit();
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <div class="container">
                <h2 class="text-center">Register</h2>
                <form action="register.php" method="POST">
                    <div class="form_group">
                        <div class="left_register">
                        <div class="form-input">
                        <label for="nama">Nama Kepala Keluarga:</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Masukan Nama kepala keluarga anda">
                    </div>
                    <div class="form-input">
                        <label for="no_kk">No. KK:</label>
                        <input type="text" name="no_kk" class="form-control" required placeholder="Masukan Nomor Kartu keluarga keluarga anda">
                    </div>
                    <div class="form-input">
                        <label for="nomor_hp">Nomor HP:</label>
                        <input type="text" name="nomor_hp" class="form-control" required placeholder="Masukan Nomor HP kepala keluarga anda">
                    </div>
                    <div class="form-input">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required placeholder="Masukan Email">
                    </div>
                        </div>
                        <div class="right_register">
                        <p style="font-size: 12px; color:red;">Pastikan password anda mengandung karakter spesial, huruf besar dan angka</p>
                    <div class="form-input">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required placeholder="Buat Password Anda">
                    </div>
                    <div class="form-input">
                        <label for="verify_password">Verify Password:</label>
                        <input type="password" name="verify_password" class="form-control" required placeholder="Verifikasi password anda">
                    </div>
                    <a href="index.php" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <br><br><p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                        </div>
                    </div>
                </form>
    </div>
</body>
</html>
