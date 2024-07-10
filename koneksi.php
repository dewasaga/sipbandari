<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SIP RT 01";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Insert
function tambah($data) {
    global $conn;
    $judul = htmlspecialchars($data["judul"]);
    $informasi = htmlspecialchars($data["informasi"]);
    $date = $data["date"]; // Ambil nilai tanggal dari form

    $query = "INSERT INTO tb_informasi (judul, informasi, date) VALUES ('$judul', '$informasi', '$date')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// Hapus
function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_informasi WHERE id = $id");
    return mysqli_affected_rows($conn);
}

// Update
function ubah($data) {
    global $conn;

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $informasi = htmlspecialchars($data["informasi"]);

    $query = "UPDATE tb_informasi SET 
                    judul = '$judul',
                    informasi = '$informasi'
                    WHERE id = $id";
  
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>
