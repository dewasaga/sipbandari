<?php
session_start();

// Periksa apakah session username sudah ada, jika tidak redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | Sistem Informasi RT</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="navbar.css"/>
    <script src="navbar.js" defer></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
</head>
<body>
    <div class="all">
    <nav class="sidebar locked" id="sidebar">
        <div class="logo_items flex">
            <span class="nav_image">
                <img src="images/logo.png" alt="" />
            </span>
            <span class="logo_name">SIP</span>
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
                        <a href="beranda.php" class="link flex">
                            <i class="bx bx-home-alt"></i>
                            <span>Informasi</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_item">
                    <div class="menu_title flex">
                        <span class="title">FORUM</span>
                        <span class="line"></span>
                    </div>
                    <li class="item">
                        <a href="input_kk.php" class="link flex">
                        <i class='bx bx-upload' ></i>
                            <span>Upload Kartu Keluarga</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="proses_saran.php" class="link flex">
                        <i class='bx bx-git-pull-request' ></i>
                            <span>Permintaan & Saran</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_item">
                    <div class="menu_title flex">
                        <span class="title">Tentang</span>
                        <span class="line"></span>
                    </div>
                    <li class="item">
                        <a href="tentang_kami.php" class="link flex">
                        <i class='far fa-question-circle'></i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="contact.php" class="link flex">
                        <i class='bx bxs-contact'></i>
                            <span>Kontak Kami</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="logout.php" class="link flex">
                        <i class='bx bx-log-out'></i>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar_profile flex">
                <span class="nav_image">
                    <img src="images/rt01.png" alt="" />
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
    </div>
    </header>

    <section>
      <div class="header">
            <h2>Tentang Kami</h2>
        </div>
        <div class="about_row">
            <div class="about_col">
                <p>
                    Selamat datang di halaman "Tentang Kami" Sistem Informasi RT. Kami adalah bagian dari inisiatif untuk meningkatkan keterbukaan informasi dan efisiensi dalam administrasi lingkungan rukun tetangga (RT).
                </p>
                <p>
                    Sistem ini dirancang untuk memudahkan warga dalam mengakses informasi terkait dengan RT mereka, termasuk informasi penting seperti pengumuman, kegiatan RT, dan layanan administratif lainnya.
                </p>
                <p>
                    Kami berkomitmen untuk memberikan pelayanan yang terbaik kepada warga dengan mengintegrasikan teknologi informasi dalam manajemen RT.
                </p>
                <p>
                    Terima kasih atas kunjungan Anda. Untuk informasi lebih lanjut, silakan hubungi kami di kontak yang tersedia.
                </p>
            </div>
        </div>
    </section>
</div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-FQFNLymBFR8HCAZfjH/y6NYqOSmZ/zIPfw3s2cB2SVCuFPJl8q5QNJF6S+W9wKlE" crossorigin="anonymous"></script>
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
