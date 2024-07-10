<?php
session_start();
include 'koneksi.php';

// Memeriksa sesi dan peran pengguna
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
  header("Location: index.php");
  exit();
}

// Memeriksa apakah ID informasi disediakan
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query untuk menghapus informasi berdasarkan ID
  $query = "DELETE FROM tb_informasi WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Jika penghapusan berhasil, kembali ke halaman admininformasi.php
    echo "<script>
            alert('Informasi berhasil dihapus');
            document.location.href = 'admininformasi.php';
          </script>";
  } else {
    // Jika penghapusan gagal, kembali ke halaman admininformasi.php dengan pesan kesalahan
    echo "<script>
            alert('Gagal menghapus informasi');
            document.location.href = 'admininformasi.php';
          </script>";
  }

  $stmt->close();
} else {
  // Jika ID tidak disediakan, kembali ke halaman admininformasi.php
  header("Location: admininformasi.php");
  exit();
}
?>
