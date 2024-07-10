<?php
include 'koneksi.php';

// Data admin
$username = 'rt';
$password = 'rt123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = 'rt';
$is_confirmed = 1;

// Tambahkan akun admin ke tabel user
$stmt = $conn->prepare("INSERT INTO user (username, password, role, is_confirmed) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $username, $hashed_password, $role, $is_confirmed);

if ($stmt->execute()) {
    echo "Akun admin berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan akun admin: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
