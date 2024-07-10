<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Hapus dari tabel profile
    $sql_profile = "DELETE FROM profile WHERE id = ?";
    $stmt_profile = $conn->prepare($sql_profile);
    if ($stmt_profile === false) {
        die('Error preparing statement (profile): ' . $conn->error);
    }
    $stmt_profile->bind_param("i", $id);
    $stmt_profile->execute();
    if ($stmt_profile->errno) {
        die('Error executing statement (profile): ' . $stmt_profile->error);
    }
    $stmt_profile->close();

    // Hapus dari tabel user
    $sql_user = "DELETE FROM user WHERE id = ?";
    $stmt_user = $conn->prepare($sql_user);
    if ($stmt_user === false) {
        die('Error preparing statement (user): ' . $conn->error);
    }
    $stmt_user->bind_param("i", $id);
    $stmt_user->execute();
    if ($stmt_user->errno) {
        die('Error executing statement (user): ' . $stmt_user->error);
    }
    $stmt_user->close();

    // Redirect kembali ke halaman adminKK.php setelah selesai menghapus
    header("Location: adminKK.php");
    exit();
} else {
    // Jika tidak ada POST data id, redirect ke halaman adminKK.php
    header("Location: adminKK.php");
    exit();
}

$conn->close();
?>
