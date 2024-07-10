<?php
include 'koneksi.php';

// Ambil data dari URL
$id = $_GET["id"];

// Query data berdasarkan id
$sql = "SELECT * FROM tb_informasi WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $upt = $result->fetch_assoc();
} else {
    echo "Data dengan ID $id tidak ditemukan";
    exit();
}

// Jika form telah disubmit untuk update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $informasi = $_POST['informasi'];

    $query = "UPDATE tb_informasi SET judul='$judul', informasi='$informasi' WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Data Berhasil Diubah');
                document.location.href = 'admininformasi.php';
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Informasi | SIP</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="footer.css"/>
    <link rel="stylesheet" href="navbar.css"/>
    <script src="navbar.js" defer></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
<div class="all">
    <nav class="sidebar locked">
        <div class="logo_items flex">
            <span class="nav_image">
                <img src="images/logo.png" alt="" />
            </span>
            <span class="logo_name">Dashboard Admin</span>
            <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
            <i class="bx bx-x" id="sidebar-close"></i>
        </div>
        <div class="menu_container">
            <div class="menu_items">
                <ul class="menu_item">
                    <div class="menu_title flex">
                        <span class="title">Beranda</span>
                        <span class="line"></span>
                    </div>
                    <li class="item">
                        <a href="admin.php" class="link flex">
                            <i class="bx bx-home-alt"></i>
                            <span>Informasi</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_item">
                    <div class="menu_title flex">
                        <span class="title">KELOLA DATA</span>
                        <span class="line"></span>
                    </div>
                    <li class="item">
                        <a href="admininformasi.php" class="link flex">
                            <i class="bx bxs-magic-wand"></i>
                            <span>Kelola Informasi</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="adminKK.php" class="link flex">
                            <i class="bx bxs-magic-wand"></i>
                            <span>Kartu Keluarga</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="adminsaran.php" class="link flex">
                            <i class="bx bx-folder"></i>
                            <span>Saran</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="adminconfirm.php" class="link flex">
                            <i class="bx bx-folder"></i>
                            <span>Konfirmasi Data</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_item">
                    <div class="menu_title flex">
                        <span class="title">Other</span>
                        <span class="line"></span>
                    </div>
                    <li class="item">
                        <a href="logout.php" class="link flex">
                            <i class="bx bx-award"></i>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar_profile flex">
                <span class="nav_image">
                    <img src="images/logo.png" alt="" />
                </span>
                <div class="data_text">
                    <span class="name">RT 01 <br> Dusun Bandari</span>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar flex">
      <i class="bx bx-menu" id="sidebar-open"></i>
    </nav>
    <section>
        <div class="header">
            <h2>Update Informasi</h2>
        </div>
        <form action="update_informasi.php?id=<?= $id ?>" method="POST">
            <input type="hidden" name="id" value="<?= $upt['id']; ?>">
            <div class="form-group">
                <label for="judul">Judul Informasi</label><br>
                <input type="text" name="judul" id="judul" value="<?= $upt['judul']; ?>"><br>
                <label for="informasi">Informasi</label><br>
                <textarea name="informasi" id="informasi" cols="65" rows="5"><?= $upt['informasi']; ?></textarea><br>
                <input type="submit" value="Update" name="update">
            </div>
        </form>
    </section>
</div>
</body>
<footer>
    <div class="content">
        <div class="top">
            <div class="logo-details">
                <span class="logo_name" style="color: #fff;">DUSUN BANDARI RT 01</span>
            </div>
        </div>
        <div class="link-boxes">
            <ul class="box">
                <li class="link_name">Dusun Bandari RT 01</li>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Kontak Kami</a></li>
            </ul>
            <ul class="box">
                <li class="link_name">Developer</li>
                <li><a href="#">Kelompok 2 / 4B</a></li>
                <li><a href="#">Teknik Informatika</a></li>
                <li><a href="#">Politeknik Negeri Ambon</a></li>
            </ul>
            <ul class="box">
                <li class="link_name">Source</li>
                <li><a href="#">HTML & CSS</a></li>
                <li><a href="#">Java Script</a></li>
                <li><a href="#">PHP & Bootstrap</a></li>
            </ul>
        </div>
        <div class="map-box">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.7108650810596!2d128.16709147460904!3d-3.65322919632079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6cef0a8a675545%3A0x916a3952f0162d7f!2sDusun%20Bandari!5e0!3m2!1sid!2sid!4v1720324849627!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="bottom-details">
        <div class="bottom_text">
            <span class="copyright_text">Copyright © 2024 <a href="#">KElOMPOK 2</a> All rights reserved</span>
            <span class="policy_terms">
                <a href="#">Privacy policy</a>
                <a href="#">Terms & condition</a>
            </span>
        </div>
    </div>
</footer>
</html>
