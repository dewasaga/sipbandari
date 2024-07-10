<?php
session_start();
session_destroy(); // Hapus semua data sesi

// Redirect ke halaman login setelah logout
header("Location: index.php");
exit();
?>
