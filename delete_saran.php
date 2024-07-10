<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Hapus dari tabel tb_saran
    $sql_saran = "DELETE FROM tb_saran WHERE id = ?";
    $stmt_saran = $conn->prepare($sql_saran);
    if ($stmt_saran === false) {
        die('Error preparing statement: ' . $conn->error);
    }
    $stmt_saran->bind_param("i", $id);
    $stmt_saran->execute();
    if ($stmt_saran->errno) {
        die('Error executing statement: ' . $stmt_saran->error);
    }
    $stmt_saran->close();

    // Redirect kembali ke halaman adminsaran.php setelah selesai menghapus
    header("Location: adminsaran.php");
    exit();
} else {
    // Jika tidak ada POST data id, redirect ke halaman adminsaran.php
    header("Location: adminsaran.php");
    exit();
}

$conn->close();
?>